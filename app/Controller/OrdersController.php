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
 	public $uses = array('Order','Product','Vary','Category','User','Vendor');
	public $components = array('Paginator', 'Flash', 'Session','RequestHandler');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
    public function beforeFilter() {
        $this->Auth->deny('index');
		$this->Auth->allow('apiAddProducts');
		$this->Auth->allow('addcart');
    }
	public function addcart() {
	    $this->layout = ''; 
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		//echo "<pre>"; print_r($this->request->data); echo "</pre>";  exit;
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			$po='ORD'.rand('111111','999999');
				$value = $this->request->data;
				$this->Order->create();
				$this->request->data['Order']['total_quantity']=$value['cartQty'];
				$this->request->data['Order']['total_price']=$value['cartSum'];
				$this->request->data['Order']['user_id']=$user['id'];
				$this->request->data['Order']['vendor'] = $value['vendor'];
				//$this->request->data['Order']['user_id']=1;
				$this->request->data['Order']['po_no']=$po;
				if($value['type']=='pending')
				$this->request->data['Order']['status']=0;
				else
				$this->request->data['Order']['status']=1;
				if ($this->Order->save($this->request->data)) {
					$i=0;
				  foreach ($value['items'] as $quan){
					  if(!empty($quan)){
						$options = array('conditions' => array('Vary.id' => $quan['id']));
						$Orders = $this->Vary->find('first',$options);
						$this->request->data['Vary']['product_id'] = $Orders['Vary']['product_id'];
						$this->request->data['Vary']['vendor'] = $quan['vendor'];
						$this->request->data['Vary']['po_no'] = $po;   
						$this->request->data['Vary']['quantity'] = $quan['qty'];
						$this->request->data['Vary']['price'] = $quan['price'];
						$this->request->data['Vary']['price_total'] = $quan['price'] * $quan['qty'];
						$this->request->data['Vary']['type'] = 'order';	
						$this->request->data['Vary']['variant'] = $Orders['Vary']['variant'];
						$this->request->data['Vary']['sku'] = $Orders['Vary']['sku'];
						$this->request->data['Vary']['metric'] = $Orders['Vary']['metric'];
						$this->request->data['Vary']['qty_type'] = $Orders['Vary']['qty_type'];
						$this->request->data['Vary']['qty'] = $Orders['Vary']['qty'];
						$this->request->data['Vary']['barcode'] = $Orders['Vary']['barcode'];
						$this->request->data['Vary']['var_id'] =$Orders['Vary']['id'];
						unset($this->Vary->validate);
						$this->Vary->create();
						$this->Vary->save($this->request->data);
						//debug($this->Vary->validationErrors); //show validationErrors 
						//exit;
						$i++;
					  }
				 }
				    $responseCart = array('orderID'=>$po,'message'=>'Purchase Order Posted Successfully','response'=>'S');
				}else {
					$responseCart = array('message'=>'Unable To save Order','response'=>'E');
				}
		}else{
		   $responseCart = array('message'=>'Request Data is Incorrect','response'=>'E');
		}
	   $this->set(array('responseCart' => $responseCart,'_serialize' => array('responseCart')));
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
		'vendor',
		'status',
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
		$vendors1= $this->Vendor->find('all');
		foreach($vendors1 as $key => $vendors) {
			if(isset($vendors['Category'][0]))
			$vendor[$vendors['Vendor']['id']]= $vendors['Vendor']['name'];
		}
		$this->set('vendor', $vendor);
	}
	
	public function apiAddProducts($value = null) {
   		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		$products = $this->Product->find('all');
		$i =0;
		foreach($products as $product){
			foreach($product['Vary'] as $key => $vary){
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i] = $product['Product'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['vid'] = $vary['id'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['variant'] = $vary['variant'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['sku'] = $vary['sku'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['barcode'] = $vary['barcode'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['price'] = $vary['price'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['vendor'] = $product['Vendor']['name'];
				$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['category'] = $product['Category']['name'];
				if(isset($value)){
				$orderVar = $this->Vary->find('first',array('conditions' => array('Vary.var_id'=> $vary['id'],'Vary.po_no'=>$value),'fields' => array('Vary.id', 'Vary.price', 'Vary.quantity','Vary.price_total','Vary.po_no')));
					if(!empty($orderVar)){
						$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['price'] = !empty($orderVar) ? $orderVar['Vary']['price'] : '';
						$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['qty'] = !empty($orderVar) ? $orderVar['Vary']['quantity'] : '';
						$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['sum'] = !empty($orderVar) ? $orderVar['Vary']['price_total'] : '';
						$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['po_no'] = !empty($orderVar) ? $orderVar['Vary']['po_no'] : '';
						$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['cv_id'] = !empty($orderVar) ? $orderVar['Vary']['id'] : '';
					}
				}
				$i++;
			}
			
				
		}
		$this->set('products', $result);
		$this->set('_serialize', array('products'));
	}

	
	public function apiEditProducts($value = null) {
      header("Access-Control-Allow-Origin: *");
	  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	  $products = $this->Product->find('all');
	  $i =0;
	  foreach($products as $product){
	   foreach($product['Vary'] as $key => $vary){
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i] = $product['Product'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['vid'] = $vary['id'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['variant'] = $vary['variant'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['sku'] = $vary['sku'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['barcode'] = $vary['barcode'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['price'] = $vary['price'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['vendor'] = $product['Vendor']['name'];
		$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['category'] = $product['Category']['name'];
			if(isset($value)){
			$orderVar = $this->Vary->find('first',array('conditions' => array('Vary.var_id'=> $vary['id'],'Vary.po_no'=>$value),'fields' => array('Vary.id', 'Vary.price', 'Vary.quantity','Vary.price_total','Vary.po_no')));
				if(!empty($orderVar)){
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['price'] = !empty($orderVar) ? $orderVar['Vary']['price'] : '';
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['qty'] = !empty($orderVar) ? $orderVar['Vary']['quantity'] : '';
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['sum'] = !empty($orderVar) ? $orderVar['Vary']['price_total'] : '';
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['po_no'] = !empty($orderVar) ? $orderVar['Vary']['po_no'] : '';
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['cv_id'] = !empty($orderVar) ? $orderVar['Vary']['id'] : '';
				}
			}
		$i++;
	   }
	   
		
	  }
	  $this->set('products', $result);
	  $this->set('_serialize', array('products'));
 }
	
	
	public function addproduct() {


	}
	
 	public function editproduct($id = null) {
	 
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
							  if(!empty($quan)){
								$this->request->data['Vary']['product_id'] = $value['product_id'];
								$this->request->data['Vary']['po_no'] = $po;   
								$this->request->data['Vary']['quantity'] = $quan;
								$this->request->data['Vary']['variant'] = $value['variant'][$i];
								$this->request->data['Vary']['sku'] = $value['sku'][$i];
								$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
								$this->request->data['Vary']['price'] = $value['price'][$i];
								$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
								$this->request->data['Vary']['type'] = 'order';	
								$this->request->data['Vary']['var_id'] =$value['var_id'][$i];
								$this->Vary->create();
								$this->Vary->save($this->request->data);
							$i++;
							  }
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
			//echo '<pre>';print_r($this->request->data);exit;
			if(isset($this->request->data['Vary'])){
				  foreach($this->request->data['Vary']  as  $value){
					 if($value['store_data']==true){
						
						if(isset($value['order_id'])){
						$this->request->data['Order']['id'] = $value['order_id'];	
						}else{
						$this->request->data['Order']['id'] = '';
						$this->Order->create();
						}
						
						$this->request->data['Order']['total_quantity']=$value['total_quantity'];
						$this->request->data['Order']['total_price']=$value['total_price'];
						$this->request->data['Order']['user_id']=$user['id'];
						$this->request->data['Order']['product_id']=$value['product_id'];
						$this->request->data['Order']['po_no']=$id;
						$this->request->data['Order']['status']=0;
						$this->Order->save($this->request->data);
							$i=0;
						  foreach ($value['quantity'] as $quan){
							  if(!empty($quan)){
							  	if(!empty($value['e_id'][$i])){
								$this->request->data['Vary']['id'] = $value['e_id'][$i];	
								}else{
								$this->request->data['Vary']['id'] = '';
								$this->Vary->create();
								}
								$this->request->data['Vary']['product_id'] = $value['product_id'];
								$this->request->data['Vary']['po_no'] = $id;   
								$this->request->data['Vary']['quantity'] = $quan;
								$this->request->data['Vary']['variant'] = $value['variant'][$i];
								$this->request->data['Vary']['sku'] = $value['sku'][$i];
								$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
								$this->request->data['Vary']['price'] = $value['price'][$i];
								$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
								$this->request->data['Vary']['type'] = 'order';
								if(isset($value['var_id'][$i]))
								$this->request->data['Vary']['var_id'] = $value['var_id'][$i];
								$this->Vary->save($this->request->data);
							  }
							  else{
								  if($quan == 0 && isset($value['e_id'])){
									  //$this->Vary->id = $value['e_id'][$i];
									  //$this->Vary->delete(array('Vary.id'=>$value['e_id'][$i]), false);
									  
									  	$this->Vary->read(null, $value['e_id'][$i]);
										$this->Vary->set('quantity', 0);
										$this->Vary->save();
									  
									  
									//echo $value['e_id'][$i];
								}
							  }
							$i++;
						 }
			 			
				  	 }}
					 //exit;
				$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
		}else{
		
		$Products= $this->Product->find('all');
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
				$pall= self::in_array_r($vary['id'], $oneProduct['VaryOrder']);
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
        if ((is_array($item) && $item['var_id'] == $needle) || (is_array($item) && self::in_array_r($needle, $item))) {
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
	
	public function download($orderId = null,$page = null)
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
		$this->set('frompage',$page);
		$this->autoLayout = false;
		Configure::write('debug', '0');
	}
	public function report($orderId = null,$page = null){
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
			//debug($Orders['Vary']); exit;
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
		$this->set('frompage',$page);
		$this->set('orderId',$orderId);
		$this->autoLayout = false;
		Configure::write('debug', '0');
	}
	
	public function emailCheck($pono = null){
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			$Email = new CakeEmail('gmail');
		    $Email->to($this->request->data['Order']['to']);
		    $Email->subject($this->request->data['Order']['subject']);
			$filename = 'PurchaseOrder_'.$pono.'.xlsx';
			$pathwithfilename = WWW_ROOT.'mailpo'.DS.$filename;
			$Email->attachments(array($filename => array('file' => $pathwithfilename)));
			if($Email->send($this->request->data['Order']['message']))
			$this->Flash->success(__('Your message has been sent.'));
			else
			$this->Flash->error(__('Message Sent failed.'));
			return $this->redirect(array('action' => 'index'));
		}else{
			$this->set('po_no', $pono);
		}
	}
	
	public function emailCheckCSV($pono = null){
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			$Email = new CakeEmail('gmail');
		    $Email->to($this->request->data['Order']['to']);
		    $Email->subject($this->request->data['Order']['subject']);
			$filename = 'PO_'.$pono.'.csv';
			$pathwithfilename = WWW_ROOT.'mailpo'.DS.$filename;
			$Email->attachments(array($filename => array('file' => $pathwithfilename)));
			echo $filename;
			debug($this->request->data); exit;
			if($Email->send($this->request->data['Order']['message']))
			$this->Flash->success(__('Your message has been sent.'));
			else
			$this->Flash->error(__('Message Sent failed.'));
			return $this->redirect(array('action' => 'index'));
		}else{
			$this->set('po_no', $pono);
		}
	}
	
	public function emailForm(){
	
			exit;
	}
	
}
