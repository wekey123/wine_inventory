<?php
App::uses('AppController', 'Controller');
/**
 * Shippings Controller
 *
 * @property Shipping $Shipping
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ShippingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Shipping','Payment','Invoice','Product','Vary','Category','Order');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Shipping->recursive = 0;
		$this->Paginator->settings = array('fields' => array(
        'SUM(shipping_quantity) as shipping_quantity',
		'invoice_quantity - SUM(shipping_quantity) as unshipped_quantity',
        'po_no',
		'invoice_no',
		'shipping_method',
		'received_date',
		'invoice_quantity',
		'user_id',
		'id'
    ),'group' => 'po_no','order' => array('created' => 'DESC'));
	//echo '<pre>';print_r($this->Paginator->paginate());exit;
		$this->set('shippings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$options = array('conditions' => array('Shipping.po_no' => $id));
		echo '<pre>';print_r($this->Shipping->find('all', $options));exit;
		$this->set('shipping', $this->Shipping->find('all', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			$this->request->data['Shipping']['user_id']= $user['id'];
			$invoices = $this->Invoice->find('first',array('conditions'=>array('Invoice.invoice_no'=>$this->request->data['Shipping']['invoice_no']),'fields'=>array('Invoice.po_no','Invoice.total_quantity')));
			if($invoices['Invoice']['total_quantity']==$this->request->data['Shipping']['shipping_quantity']){
			$this->Invoice->updateAll(array('Invoice.status' => 3),array('Invoice.invoice_no' => $this->request->data['Shipping']['invoice_no']));
			$this->Order->updateAll(array('Order.status' => 3),array('Order.po_no' => $invoices['Invoice']['po_no']));
			$this->request->data['Shipping']['status']= 3;
			}
			else{
			$this->Invoice->updateAll(array('Invoice.status' => 2),array('Invoice.invoice_no' => $this->request->data['Shipping']['invoice_no']));
			$this->request->data['Shipping']['status']= 2;
			}
			
			$this->request->data['Shipping']['po_no']= $invoices['Invoice']['po_no'];
			//echo '<pre>';print_r($this->request->data);exit;
			$this->Shipping->create();
			if ($this->Shipping->save($this->request->data)) {
				$this->Flash->success(__('The shipping has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				debug($this->Shipping->validationErrors);
				$this->Flash->error(__('The shipping could not be saved. Please, try again.'));
			}
		}else{
			$invoices = $this->Invoice->find('all',array('conditions'=>array('Invoice.status'=>array(1,2)),'fields'=>array('Invoice.invoice_no'),'group'=>'Invoice.invoice_no'));
			foreach($invoices as $invoice){
				$invoicelist[]=$invoice['Invoice']['invoice_no'];
			}
			$this->set(compact('invoicelist'));
		}
		$invoices = $this->Shipping->Invoice->find('list');
		$this->set(compact('invoices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Shipping->exists($id)) {
			throw new NotFoundException(__('Invalid shipping'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Shipping->save($this->request->data)) {
				$this->Flash->success(__('The shipping has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The shipping could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Shipping.' . $this->Shipping->primaryKey => $id));
			$this->request->data = $this->Shipping->find('first', $options);
		}
		$invoices = $this->Shipping->Invoice->find('list');
		$this->set(compact('invoices'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Shipping->id = $id;
		if (!$this->Shipping->exists()) {
			throw new NotFoundException(__('Invalid shipping'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Shipping->delete()) {
			$this->Flash->success(__('The shipping has been deleted.'));
		} else {
			$this->Flash->error(__('The shipping could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
