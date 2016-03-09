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
		$this->set('payments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
		$this->set('payment', $this->Payment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Payment->create();
			if ($this->Payment->save($this->request->data)) {
				$this->Flash->success(__('The payment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The payment could not be saved. Please, try again.'));
			}
		}
		$invoices = $this->Payment->Invoice->find('all',array('fields'=>array('Invoice.invoice_no'),'group'=>'Invoice.invoice_no'));
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
	public function edit($id = null) {
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
