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
	public $uses = array('Invoice','Product','Vary','Category','Order','InvoiceColumn');
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
				 'InvoiceColumn' => array('foreignKey' => false,
                                    'conditions' => array('InvoiceColumn.invoice_no' => $no)
                                ),
                            )
                ),
            false
        );
		
		
		if (!$this->Invoice->find('count', array('conditions' => array('Invoice.invoice_no'=>$no)))) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		$options = array('conditions' => array('Invoice.invoice_no'=> $no));
		//echo '<pre>';print_r($this->Invoice->find('first', $options));exit;
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
			//echo '<pre>';print_r($this->request->data);exit;
			if(empty($invoiceExist)){
			$this->Invoice->create();
			if ($this->Invoice->save($this->request->data)) {
				
				if(isset($this->request->data['col'])){
				foreach($this->request->data['col'] as $col){
					$this->request->data['InvoiceColumn']['invoice_id'] = $this->Invoice->getLastInsertId();
					$this->request->data['InvoiceColumn']['invoice_no'] = $this->request->data['Invoice']['invoice_no'];  
					$this->request->data['InvoiceColumn']['po_no'] =  $this->request->data['Invoice']['po_no'];  
					$this->request->data['InvoiceColumn']['heading'] = $col['coloumn'];
					$this->request->data['InvoiceColumn']['value'] =$col['value'];
					$this->InvoiceColumn->create();
				    $this->InvoiceColumn->save($this->request->data);
				 }
				}
				
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
						$this->request->data['Vary']['var_id'] = $value['var_id'][$i];
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
			//echo '<pre>';print_r($this->request->data);exit;
			if ($this->Invoice->save($this->request->data)) {
				if(isset($this->request->data['col'])){
				foreach($this->request->data['col'] as $col){
					$this->request->data['InvoiceColumn']['invoice_id'] = $this->request->data['Invoice']['id']; 
					$this->request->data['InvoiceColumn']['invoice_no'] = $this->request->data['Invoice']['invoice_no'];  
					$this->request->data['InvoiceColumn']['po_no'] =  $this->request->data['Invoice']['po_no'];  
					$this->request->data['InvoiceColumn']['heading'] = $col['coloumn'];
					$this->request->data['InvoiceColumn']['value'] =$col['value'];
					$this->request->data['InvoiceColumn']['id']= isset($col['id']) ? $col['id'] : '';
					$this->InvoiceColumn->create();
				    $this->InvoiceColumn->save($this->request->data);
				 }
				}
				
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
						$this->request->data['Vary']['var_id'] = $value['var_id'][$i];
						$this->request->data['Vary']['id'] = isset($value['inv_id']) ? $value['inv_id'][$i] : '';
						$this->Vary->create();
						$this->Vary->save($this->request->data);
						$i++;
					}
				 
				$this->Order->updateAll(array('Order.status' => 1),array('Order.po_no' => $this->request->data['Invoice']['po_no']));
					
				$this->Flash->success(__('The invoice has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
				
				$this->Flash->success(__('The invoice has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The invoice could not be saved. Please, try again.'));
			}
		} else {
			 $this->Invoice->UnbindModel(array('hasMany'=>'Vary'));
			$options = array('conditions' => array('Invoice.' . $this->Invoice->primaryKey => $id));
			$this->request->data = $this->Invoice->find('first', $options);
			// Varient table List
			$po_no=$this->request->data['Invoice']['po_no'];
			$invoice_no=$this->request->data['Invoice']['invoice_no'];
			 $this->Order->recursive = 2;
			 $this->Order->bindModel(array(
				'hasMany' => array(
					'Vary' => array('foreignKey' => false,
										'conditions' => array('Vary.po_no'=>array($invoice_no, $po_no))))),
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
		),'conditions' => array('Order.po_no'=> $po_no));
			$ordInv=$this->Order->find('first', $options);
			$i=0;
			foreach($ordInv['Vary'] as $invCount){
				if($invCount['type']=='order'){
					$pall= self::in_array_r($invCount['id'], $ordInv['Vary']);
					 $ordInv['Vary'][$i]['inv_count']= $pall['quantity'];
					 $ordInv['Vary'][$i]['inv_id']= $pall['id'];
				}
			$i++;
			}
			
		  $this->set('order', $ordInv);
		  //echo '<pre>';print_r($ordInv);exit;
		}
		$orders = $this->Invoice->Order->find('list');
		$this->set(compact('orders'));
	}


  public function in_array_r($needle, $haystack, $strict = false) {
   foreach ($haystack as $item) {
        if($item['var_id']==$needle){
            return $item;
        }
    }

    return false;
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
	
	public function invoiceChk($value = null){
		$this->layout = '';
		$this->autoRender = false ;
		$value=$_POST['label'];
		$options = array('conditions' => array('Invoice.invoice_no'=> $value));
		$val=$this->Invoice->find('first', $options);
		if(isset($val['Invoice']))
		return true;
		else
		return false;
	}
	
}
