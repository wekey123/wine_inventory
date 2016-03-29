<?php
App::uses('AppController', 'Controller');
/**
 * Payments Controller
 *
 * @property Payment $Payment
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PaymentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Payment','Invoice','Product','Vary','Category','Order');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Payment->recursive = 0;		
		$this->Paginator->settings = array('fields' => array(
		'SUM(Payment.payment_amount) as total_amount',
		'SUM(Payment.payment_qty) as total_quantity',
        'Payment.id',
		'Payment.po_no',
		'Payment.invoice_no',
		'Payment.payment_no',
		'Payment.payment_amount',
		'Payment.payment_qty',
		'Payment.payment_date',
		'Payment.payment_method',
		'Payment.created',
		'Payment.modified',
		'User.username',
		'User.id'),'group' => 'Payment.invoice_no', 'order' => array('Payment.created' => 'desc'));
		//debug($this->Paginator->paginate()); exit;
		$this->set('payments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($no = null) {
		
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
		 $paymentView = $this->Invoice->find('first', $options);
	     if(!empty($paymentView)){
		 $this->set('invoice', $paymentView);
		 }else{
		 $this->Flash->success(__('Invalid invoice Number.'));
		 return $this->redirect(array('action' => 'index'));
		 }

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			//debug($this->request->data); exit;
			$this->request->data['Payment']['user_id'] = $user['id'];
			$this->request->data['Payment']['payment_date'] = date("Y-m-d", strtotime($this->request->data['Payment']['payment_date']));
			$this->request->data['Payment']['payment_amount'] = str_replace(array( ',','$'), '', $this->request->data['Payment']['payment_amount']);
			$this->Payment->create();
			if ($this->Payment->save($this->request->data)) {
				if(($this->request->data['dueAmount']-str_replace(array( ',','$'), '', $this->request->data['Payment']['payment_amount'])) <= 0){
					$this->Invoice->updateAll(array('Invoice.status' => 2),array('Invoice.invoice_no' => $this->request->data['Payment']['invoice_no']));
					$this->Order->updateAll(array('Order.status' => 2),array('Order.po_no' => $this->request->data['Payment']['po_no']));
				}
				else
					$this->Invoice->updateAll(array('Invoice.status' => 1),array('Invoice.invoice_no' => $this->request->data['Payment']['invoice_no']));
				
				$this->Flash->success(__('The payment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The payment could not be saved. Please, try again.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$invoices = $this->Payment->Invoice->find('all',array('conditions'=>array('Invoice.status'=>array(0,1)),'fields'=>array('Invoice.invoice_no'),'group'=>'Invoice.invoice_no'));
		foreach($invoices as $invoice){
			$invoicelist[]=$invoice['Invoice']['invoice_no'];
		}
		$this->set(compact('invoicelist'));
		/*$invoices = $this->Payment->Invoice->find('list');
		$this->set(compact('invoices'));*/
	}
	
	
	/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($no = null) {
		
		if ($this->request->is(array('post', 'put'))) {
			$payments = $this->request->data['Payment'];
			foreach($payments as $payment){
				$this->request->data['Payment'] = $payment;
				$this->request->data['Payment']['payment_date'] = date("Y-m-d", strtotime($this->request->data['Payment']['payment_date']));
				$this->request->data['Payment']['payment_amount'] = str_replace(array( ',','$'), '', $this->request->data['Payment']['payment_amount']);
				$this->Payment->id = $this->request->data['Payment']['id'];
				$this->Payment->save($this->request->data);
			}
			$this->Flash->success(__('The payment has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
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
			 $paymentView = $this->Invoice->find('first', $options);
			 if(!empty($paymentView)){
			 $this->set('invoice', $paymentView);
			 $this->request->data = $paymentView;
			 }else{
			 $this->Flash->success(__('Invalid invoice Number.'));
			 return $this->redirect(array('action' => 'index'));
			 }
		} 
	}
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit1($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Payment->save($this->request->data)) {
				$this->Flash->success(__('The payment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The payment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
			$this->request->data = $this->Payment->find('first', $options);
		}
		$invoices = $this->Payment->Invoice->find('list');
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
		$this->Payment->id = $id;
		if (!$this->Payment->exists()) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Payment->delete()) {
			$this->Flash->success(__('The payment has been deleted.'));
		} else {
			$this->Flash->error(__('The payment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function ajax($value = null) {
		 $this->layout = '';
		 $this->autoRender = false ;
		 $this->viewPath = 'elements';
		 $no=$_POST['label'];
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
		 $this->set('invoice', $this->Invoice->find('first', $options));
		 $this->render('payment');
	}
	
}
