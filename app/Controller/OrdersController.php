<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
 	public $uses = array('Order','Product','Vary','Category','User');
	public $components = array('Paginator', 'Flash', 'Session');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
    public function beforeFilter() {
        $this->Auth->deny('index');
    }
	
	public function index() {
		$this->Paginator->settings = array('fields' => array(
        'SUM(total_quantity) as total_quantity',
		'SUM(total_price) as total_price',
        'po_no',
		'user_id',
		'created',
		'modified',
		'Product.title',
		'Product.id',
		'User.username',
		'User.id'
    ),'group' => 'po_no');
		$this->Order->recursive = 0;
		$this->set('orders', $this->Paginator->paginate());//echo '<pre>';print_r($this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($no = null) {
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
		if (!$this->Order->find('count', array('conditions' => array('Order.po_no'=>$no)))) {
			throw new NotFoundException(__('Invalid order'));
		}
		$options = array('fields' => array(
        'SUM(total_quantity) as total_quantity',
		'SUM(total_price) as total_price',
        'po_no',
		'user_id',
		'created',
		'modified'
    ),'conditions' => array('Order.po_no'=> $no));
		$this->set('order', $this->Order->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			$po='ORD'.rand('111111','999999');
			if(isset($this->request->data['Vary'])){
				  foreach($this->request->data['Vary']  as  $value){
					 if($value['total_quantity']==true){
						$this->Order->create();
						$this->request->data['Order']['total_quantity']=$value['total_quantity'];
						$this->request->data['Order']['total_price']=$value['total_price'];
						$this->request->data['Order']['user_id']=$user['id'];
						$this->request->data['Order']['product_id']=$value['product_id'];
						$this->request->data['Order']['po_no']=$po;
						$this->request->data['Order']['status']=0;
						if ($this->Order->save($this->request->data)) {
							$i=1;
						  foreach ($value['quantity'] as $quan){
								$this->request->data['Vary']['product_id'] = $value['product_id'];
								$this->request->data['Vary']['po_no'] = $po;   
								$this->request->data['Vary']['quantity'] = $quan;
								$this->request->data['Vary']['variant'] = $value['variant'][$i];
								$this->request->data['Vary']['sku'] = $value['sku'][$i];
								$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
								$this->request->data['Vary']['price'] = $value['price'][$i] * $quan;
								$this->request->data['Vary']['type'] = 'order';		
								$this->Vary->create();
								$this->Vary->save($this->request->data);
							$i++;
						 }
			 			}
						 else {
							$this->Flash->error(__('The order could not be saved. Please, try again.'));
						}
				  	 }
				}
				$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
		}else{
		/*$products = $this->Order->Product->find('list');
		$this->set(compact('products'));*/
		//$options = array('conditions' => array('Product.user_id' => 0));
		$products= $this->Product->find('all');
		$this->set('products', $products);
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
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
		$products = $this->Order->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Order->delete()) {
			$this->Flash->success(__('The order has been deleted.'));
		} else {
			$this->Flash->error(__('The order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function download()
	{
		//$this->Order->recursive = 2;
		$this->Order->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.type' => 'order','Vary.po_no !='=>'')
                                ),
                            )
                ),
            false
        );
		$options = array('group' => 'Order.po_no');
		$Orders = $this->Order->find('all',$options);
		//debug($Orders); exit;
		$this->set('orders', $this->Order->find('all'));
		$this->layout = null;
		//$this->autoLayout = false;
		//Configure::write('debug', '0');
	}
}
