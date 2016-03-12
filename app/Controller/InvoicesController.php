<?php
App::uses('AppController', 'Controller');
/**
 * Invoices Controller
 *
 * @property Invoice $Invoice
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class InvoicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Invoice','Product','Vary','Category','Order');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
	public $layout = 'admin';
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Invoice->recursive = 0;
		//debug($this->Paginator->paginate());
		$this->set('invoices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
	public function view($no = null) {
		$this->Invoice->recursive = 2;
		$this->Invoice->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.type' => 'invoice','Vary.po_no'=>$no)
                                ),
                            )
                ),
            false
        );
		
		
		if (!$this->Invoice->find('count', array('conditions' => array('Invoice.invoice_no'=>$no)))) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		$options = array('conditions' => array('Invoice.invoice_no'=> $no));
		//debug($this->Invoice->find('first', $options)); exit;
		$this->set('invoice', $this->Invoice->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			//$po='INV'.rand();
			$this->request->data['Invoice']['user_id']=$user['id'];
			$this->request->data['Invoice']['status']=0;
			//$this->request->data['Invoice']['invoice_no']=$po;
			$this->request->data['Invoice']['invoice_date'] = date("Y-m-d", strtotime($this->request->data['Invoice']['invoice_date']));
			$this->request->data['Invoice']['estimated_shipping_date'] = date("Y-m-d", strtotime($this->request->data['Invoice']['estimated_shipping_date']));
			//echo '<pre>';print_r($this->request->data);exit;
			$options = array('conditions' => array('Invoice.invoice_no'=> $this->request->data['Invoice']['invoice_no']));
			$invoiceExist=$this->Invoice->find('first', $options);
			//echo '<pre>';print_r($invoiceExist);exit;
			if(empty($invoiceExist)){
			$this->Invoice->create();
			if ($this->Invoice->save($this->request->data)) {
				if(isset($this->request->data['Vary'])){
					$i=1;
				$value = $this->request->data['Vary'];
				  foreach($value['quantity']  as  $quan){
						$this->request->data['Vary']['product_id'] = $value['product_id'][$i];
						$this->request->data['Vary']['po_no'] = $this->request->data['Invoice']['invoice_no'];   
						$this->request->data['Vary']['quantity'] = $quan;
						$this->request->data['Vary']['variant'] = $value['variant'][$i];
						$this->request->data['Vary']['sku'] = $value['sku'][$i];
						$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
						$this->request->data['Vary']['price'] = $value['price'][$i];
						$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
						$this->request->data['Vary']['type'] = 'invoice';		
						$this->Vary->create();
						$this->Vary->save($this->request->data);
						$i++;
					}
					
				$this->Order->updateAll(array('Order.status' => 1),array('Order.po_no' => $this->request->data['Invoice']['po_no']));
					
				$this->Flash->success(__('The invoice has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			} else {
				$this->Flash->error(__('The invoice could not be saved. Please, try again.'));
				return $this->redirect(array('action' => 'index'));
			}
		  }
		  else {
				$this->Flash->error(__('The invoice number exist already.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$orders = $this->Invoice->Order->find('all',array('conditions'=>array('Order.status'=>0),'fields'=>array('Order.po_no'),'group'=>'Order.po_no'));
		
		if(empty($orders)){
			$this->Flash->success(__('Currently No order has been added. Please make the order.'));
			return $this->redirect(array('action' => 'index'));
		}else{
		foreach($orders as $order){
			$orderlist[]=$order['Order']['po_no'];
		}
		$this->set(compact('orderlist'));
		//echo '<pre>';print_r($orders);
		$this->set(compact('orders'));
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Invoice->exists($id)) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Invoice->save($this->request->data)) {
				$this->Flash->success(__('The invoice has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The invoice could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Invoice.' . $this->Invoice->primaryKey => $id));
			$this->request->data = $this->Invoice->find('first', $options);
		}
		$orders = $this->Invoice->Order->find('list');
		$this->set(compact('orders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Invoice->id = $id;
		if (!$this->Invoice->exists()) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Invoice->delete()) {
			$this->Flash->success(__('The invoice has been deleted.'));
		} else {
			$this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function ajax($value = null) {
		 $this->layout = '';
		 $this->autoRender = false ;
		 $this->viewPath = 'elements';
		 $no=$_POST['label'];
		 $this->Order->recursive = 2;
		 $this->Order->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.type' => 'order','Vary.po_no'=>$no)
                                ),
                            )
                ),
            false
        );
		$this->Order->unbindModel(array('belongsTo' => 'Product'));
		$options = array('fields' => array(
        'SUM(total_quantity) as total_quantity',
		'SUM(total_price) as total_price',
        'po_no',
		'user_id',
		'created',
		'modified'
    ),'conditions' => array('Order.po_no'=> $no));
		$this->set('order', $this->Order->find('first', $options));
		 $this->render('invoice');
	}
	
}
