<?php
App::uses('AppController', 'Controller');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class InventoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Inventory','Payment','Invoice','Product','Vary','Category','Order','Shipping','User','Vendor');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Inventory->recursive = 0;
		$this->set('inventories', $this->Paginator->paginate());
	}


	public function lists(){
		$product = $this->Product->find('all');
		self::categoryList();
		$this->set('products', $product);
		//echo '<pre>';print_r($product);exit;
	}

	private function categoryList(){
		$vendors1= $this->Vendor->find('all');
		//$vendor[0] = 'Select Vendor';
		foreach($vendors1 as $key => $vendors) {
			if(isset($vendors['Category'][0]))
			$vendor[$vendors['Vendor']['id']]= $vendors['Vendor']['name'];
		}
		$this->set('vendor', $vendor);
		
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $ord_id= null, $inv_id = null) {
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->Inventory->recursive = 1;
		$this->Inventory->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.po_no'=>array($ord_id,$inv_id))
                                ),
				'Payment' => array('foreignKey' => false,
                                    'conditions' => array('Payment.invoice_no'=>$inv_id)
                                ),
				'Order' => array('foreignKey' => false,
									'conditions' => array('Order.po_no'=>$ord_id),
                                    'fields' => array(
									'SUM(total_quantity) as total_quantity','SUM(total_price) as total_price','po_no','user_id','created','modified',
									),'group' => 'po_no'
								),
                            ),
			'hasOne'=> array(
                'Shipping' => array('foreignKey' => false,
                                    'conditions' => array('Shipping.po_no'=>$ord_id)
                                )
                            )
                ),
            false
        );
		$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
		//echo '<pre>';print_r($this->Inventory->find('first', $options));
		$this->set('inventory', $this->Inventory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
		 	$this->request->data['Inventory']['user_id']= $user['id'];
			$this->request->data['Inventory']['shipping_no'] = $this->request->data['Shipping']['shipping_no'];
			$this->request->data['Inventory']['total_quantity'] = $this->request->data['Shipping']['shipping_quantity'];
			$this->request->data['Shipping']['user_id'] = $user['id'];
			$this->request->data['Inventory']['invoice_no'] = $this->request->data['Shipping']['invoice_no']; 
			$this->request->data['Shipping']['po_no'] = $this->request->data['Inventory']['po_no']; 
			$this->request->data['Shipping']['received_date'] = date("Y-m-d", strtotime($this->request->data['Shipping']['received_date']));
			//echo '<pre>';print_r($this->request->data);exit;
			$this->Shipping->create();
			if ($this->Shipping->save($this->request->data)) {
				$this->Inventory->create();
				if ($this->Inventory->save($this->request->data)) {
					
				if(isset($this->request->data['Vary'])){
					$i=1;
					$value = $this->request->data['Vary'];
				  	foreach($value['quantity']  as  $quan){
						$this->request->data['Vary']['product_id'] = $value['product_id'][$i];
						$this->request->data['Vary']['po_no'] = $this->request->data['Inventory']['po_no'];   
						$this->request->data['Vary']['quantity'] = $quan;
						$this->request->data['Vary']['variant'] = $value['variant'][$i];
						$this->request->data['Vary']['sku'] = $value['sku'][$i];
						$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
						$this->request->data['Vary']['price'] = $value['price'][$i];
						$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
						$this->request->data['Vary']['defect'] = $value['defect_quantity'][$i];
						$this->request->data['Vary']['missing'] = $value['missing_quantity'][$i];
						$this->request->data['Vary']['type'] = 'inventory';		
						$this->Vary->create();
						$this->Vary->save($this->request->data);
						$i++;
					}
					$this->Invoice->updateAll(array('Invoice.status' => 4),array('Invoice.invoice_no' => $this->request->data['Inventory']['invoice_no']));
					$this->Order->updateAll(array('Order.status' => 4),array('Order.po_no' => $this->request->data['Inventory']['po_no']));
					$this->Shipping->updateAll(array('Shipping.status' => 4),array('Shipping.po_no' => $this->request->data['Inventory']['po_no']));
					$this->Flash->success(__('The inventory has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
					$this->Flash->error(__('The Variant could not be saved. Please, try again.'));
					
				} else {
					$this->Flash->error(__('The inventory could not be saved. Please, try again.'));
				}
			} else {
					$this->Flash->error(__('The Shipping could not be saved. Please, try again.'));
			}
		}else{
			$invoices = $this->Invoice->find('all',array('conditions'=>array('Invoice.status'=>array(2,3)),'fields'=>array('Invoice.invoice_no'),'group'=>'Invoice.invoice_no'));
			foreach($invoices as $invoice){
				$invoicelist[]=$invoice['Invoice']['invoice_no'];
			}
			$this->set(compact('invoicelist'));
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
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Inventory->save($this->request->data)) {
				$this->Flash->success(__('The inventory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The inventory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
			$this->request->data = $this->Inventory->find('first', $options);
		}
		$users = $this->Inventory->User->find('list');
		$orders = $this->Inventory->Order->find('list');
		$this->set(compact('users', 'orders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Inventory->delete()) {
			$this->Flash->success(__('The inventory has been deleted.'));
		} else {
			$this->Flash->error(__('The inventory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function ajax($value = null) {
		  $this->layout = '';
		 $this->autoRender = false ;
		 $this->viewPath = 'Elements';
		$no=$_POST['label'];
		//$no= 'INV25797';
		$this->Invoice->recursive = 2;
		$this->Invoice->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.type' => 'invoice','Vary.po_no'=>$no)
                                ),
				'Payment' => array('foreignKey' => false,
                                    'conditions' => array('Payment.invoice_no' => $no)
                                ),
                            )
                ),
            false
        );
		 $options = array('conditions' => array('Invoice.invoice_no' => $no));
		 $this->set('order', $this->Invoice->find('first', $options));
		 $this->render('inventory');
		//echo '<pre>';print_r($this->Invoice->find('first', $options));exit;
	}
	
}
