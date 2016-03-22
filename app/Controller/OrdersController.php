<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
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
		if ($this->request->is('post')) {
			$start_date_timestamp = strtotime($this->request->data['dateFrom']);
			$end_date_timestamp = strtotime($this->request->data['dateTo']);
			$sdate = date('Y-m-d', $start_date_timestamp);
			$edate = date('Y-m-d', $end_date_timestamp);
			$cond= array('Order.created  BETWEEN ? and ?'  => array($sdate.' 00:00:00', $edate.' 23:59:59'));
			$this->set('data',$this->request->data);
		}else
		$cond= array('');
		
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
    ),'conditions'=>$cond,'group' => 'po_no','order' => array('created' => 'DESC'));
		$this->Order->recursive = 1;
		$this->Order->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.type' => 'order')
                                ),
                            )
                ),
            false
        );
		$this->set('orders', $this->Paginator->paginate());
		//echo '<pre>';print_r($this->Paginator->paginate());exit;
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
			//echo '<pre>';print_r($this->request->data);exit;
			if(isset($this->request->data['Vary'])){
				  foreach($this->request->data['Vary']  as  $value){
					 if($value['store_data']==true){
						$this->Order->create();
						$this->request->data['Order']['total_quantity']=$value['total_quantity'];
						$this->request->data['Order']['total_price']=$value['total_price'];
						$this->request->data['Order']['user_id']=$user['id'];
						$this->request->data['Order']['product_id']=$value['product_id'];
						$this->request->data['Order']['po_no']=$po;
						$this->request->data['Order']['status']=0;
						if ($this->Order->save($this->request->data)) {
							$i=0;
						  foreach ($value['quantity'] as $quan){
								$this->request->data['Vary']['product_id'] = $value['product_id'];
								$this->request->data['Vary']['po_no'] = $po;   
								$this->request->data['Vary']['quantity'] = $quan;
								$this->request->data['Vary']['variant'] = $value['variant'][$i];
								$this->request->data['Vary']['sku'] = $value['sku'][$i];
								$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
								$this->request->data['Vary']['price'] = $value['price'][$i];
								$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
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
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			$po='ORD'.rand('111111','999999');
			//echo '<pre>';print_r($this->request->data);exit;
			if(isset($this->request->data['Vary'])){
				  foreach($this->request->data['Vary']  as  $value){
					 if($value['store_data']==true){
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
								$this->request->data['Vary']['price'] = $value['price'][$i];
								$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
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
		
		$Products= $this->Product->find('all');
		//$this->set('products', $Products);
		//echo '<pre>';print_r($Products);exit;
		
		
		
		//$Products = $this->Product->find('list', array('fields' => array('Product.id')));
		$productsall=array();
		foreach ($Products as $Producteach)	{
			$this->Product->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.po_no'=>$id,'Vary.product_id'=>$Producteach['Product']['id'])
                                ),
				'Order' => array('foreignKey' => false,
                                    'conditions' => array('Order.status' => 0,'Order.po_no'=>$id,'Order.product_id'=>$Producteach['Product']['id'])
                                ),
                            ),
					),
					
				false
			);
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $Producteach['Product']['id']));
			$oneProduct=$this->Product->find('first', $options);
			$oneProduct['VaryOrder']=$oneProduct['Vary'];
			$oneProduct['Vary']=$Producteach['Vary'];
			$k=0;
			foreach ($oneProduct['Vary'] as $vary){
				$pall= self::in_array_r($vary['sku'], $oneProduct['VaryOrder']);
				$oneProduct['Vary'][$k]['price']=isset($pall['price']) ? $pall['price'] : $oneProduct['Vary'][$k]['price'];
				$oneProduct['Vary'][$k]['quantity']=isset($pall['quantity']) ? $pall['quantity'] : $oneProduct['Vary'][$k]['quantity'];
				$oneProduct['Vary'][$k]['po_no']=isset($pall['po_no']) ? $pall['po_no'] : $oneProduct['Vary'][$k]['po_no'];
				$oneProduct['Vary'][$k]['e_id']=$pall['id'];
			$k++;
			}
			
			$productsall[]= $oneProduct;
		}
		$this->set('products', $productsall);
		//echo '<pre>';print_r($productsall);
		//exit;
		}
	}

public function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
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
	
	public function download($orderId = null)
	{
		$this->layout = null;
		$this->Order->bindModel(array('hasMany' => array('Vary' => array('foreignKey' => false,'conditions' => array('Vary.type' => 'order','Vary.po_no'=>$orderId)))),false);
		$options = array('conditions' => array('Order.po_no' => $orderId),'group' => 'Order.po_no');
		$Orders = $this->Order->find('first',$options);
		$i =0;
		$total[1] = '';
		$total[2] = '';
		$total[3] = '';
		$total[4] = '';
		$total[5] = '';
		$total[6] = '';
		$total[7] = '';
		$total[8] = 0;
		$total[9] = '';
		$total[10] = 0.00;
			foreach($Orders['Vary'] as $vary){
				$result[$vary['po_no']][$i]['SNO'] = $i+1;
				$result[$vary['po_no']][$i]['PO NUMBER'] = $vary['po_no'];
				$options = array('conditions' => array('Product.id' => $vary['product_id']));
				$product_array = $this->Product->find('first',$options);
				$result[$vary['po_no']][$i]['PRODUCT NAME'] = $product_array['Product']['title'];
				$result[$vary['po_no']][$i]['CATEGORY NAME'] = $product_array['Product']['category_name'];
				$result[$vary['po_no']][$i]['SIZE'] = $vary['variant'];
				$result[$vary['po_no']][$i]['SKU'] = $vary['sku'];
				$result[$vary['po_no']][$i]['BARCODE'] = $vary['barcode'];
				$result[$vary['po_no']][$i]['QTY'] = $vary['quantity'];
				$price = number_format($vary['price'], 2, '.', '');
				$result[$vary['po_no']][$i]['PRICE'] = '$'.$price;
				$extended_price = number_format(($vary['quantity']*$price), 2, '.', '');
				$result[$vary['po_no']][$i]['EXTENDED PRICE'] = '$'.$extended_price;
				$total[8] += $vary['quantity'];
				$total[10] += number_format($extended_price, 2, '.', '');
				$i++;
			}
			
		$total[10] = '$'.number_format($total[10], 2, '.', '');
		$this->set('orders', $result);
		$this->set('totals', $total);
		$this->autoLayout = false;
		Configure::write('debug', '0');
	}
	public function report($orderId = null)
	{
		$this->layout = null;
		$this->Order->bindModel(array('hasMany' => array('Vary' => array('foreignKey' => false,'conditions' => array('Vary.type' => 'order','Vary.po_no'=>$orderId)))),false);
		$options = array('conditions' => array('Order.po_no' => $orderId),'group' => 'Order.po_no');
		$Orders = $this->Order->find('first',$options);
		$i =0;
		$total[1] = '';
		$total[2] = '';
		$total[3] = '';
		$total[4] = '';
		$total[5] = '';
		$total[6] = '';
		$total[7] = '';
		$total[8] = 0;
		$total[9] = '';
		$total[10] = 0.00;
			debug($Orders['Vary']); exit;
			foreach($Orders['Vary'] as $vary){
			
				$result[$vary['po_no']][$i]['SNO'] = $i+1;
				$result[$vary['po_no']][$i]['PO NUMBER'] = $vary['po_no'];
				$options = array('conditions' => array('Product.id' => $vary['product_id']));
				$product_array = $this->Product->find('first',$options);
				$result[$vary['po_no']][$i]['PRODUCT NAME'] = $product_array['Product']['title'];
				$result[$vary['po_no']][$i]['CATEGORY NAME'] = $product_array['Product']['category_name'];
				$result[$vary['po_no']][$i]['SIZE'] = $vary['variant'];
				$result[$vary['po_no']][$i]['SKU'] = $vary['sku'];
				$result[$vary['po_no']][$i]['BARCODE'] = $vary['barcode'];
				$result[$vary['po_no']][$i]['QTY'] = $vary['quantity'];
				$price = number_format($vary['price'], 2, '.', '');
				$result[$vary['po_no']][$i]['PRICE'] = '$'.$price;
				$extended_price = number_format(($vary['quantity']*$price), 2, '.', '');
				$result[$vary['po_no']][$i]['EXTENDED PRICE'] = '$'.$extended_price;
				$total[8] += $vary['quantity'];
				$total[10] += number_format($extended_price, 2, '.', '');
				$i++;
			}
			
		$total[10] = '$'.number_format($total[10], 2, '.', '');
		//debug($result); exit;
		$this->set('data', $result);
		$this->set('totals', $total);
		$this->autoLayout = false;
		Configure::write('debug', '0');
	}
	
	public function emailCheck(){
			$Email = new CakeEmail('gmail');
		    $Email->to('mail2rmvignesh@gmail.com');
		    $Email->subject('About');
			$filename = 'logo.png';
			$path = WWW_ROOT.'img'.DS.$filename;
			$Email->attachments(array('attachment_PO_image.png' => array('file' => $path)));
			if($Email->send('My message'))
			echo 'success';
			else
			echo 'failed';
			exit;
	}
}
