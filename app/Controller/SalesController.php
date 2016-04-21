<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property RequesrHandlerComponent $RequesrHandler
 * @property SessionComponent $Session
 */
class SalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Sale','Product','Vary','Order','Invoice','Shipping','Payment','Category','User','Vendor');
	public $components = array('Paginator', 'Flash', 'Session','RequestHandler');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sale->recursive = 0;
		$this->set('sales', $this->Paginator->paginate());
		self::categoryList();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function view($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
		$this->set('sale', $this->Sale->find('first', $options));
	}*/
	
	public function view($no = null) {
		
		 $this->Sale->bindModel(array('hasMany' => array('Vary' => array('foreignKey' => false,'conditions' => array('Vary.type' => 'sales','Vary.po_no'=>$no)))),false);
		 $options = array('conditions' => array('Sale.sales_no' => $no));
		 $salesView = $this->Sale->find('first', $options);
	     if(!empty($salesView)){
		 $this->set('sale', $salesView);
		 }else{
		 $this->Flash->success(__('Invalid Sales Number.'));
		 return $this->redirect(array('action' => 'index'));
		 }
		 
		$total=array('');
		$total=array('sold_qty'=>0,'cr_qty'=>0,'mfg_return_qty'=>0);
		foreach($salesView['Vary'] as $prod){
			$total['sold_qty']+=$prod['sold_qty'];
			$total['cr_qty']+=$prod['cr_qty'];
			$total['mfg_return_qty']+=$prod['mfg_return_qty'];
		}
		$this->set('prodTotal', $total);

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
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sale->create();
			if ($this->Sale->save($this->request->data)) {
				$this->Flash->success(__('The sale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The sale could not be saved. Please, try again.'));
			}
		}
	}
	
	public function addproduct() {

	}
	
	
	public function apiAddProducts($value = null) {
		//Configure::write('debug', 0);
   		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		$products = $this->Product->find('all');
		//debug($products); exit;
		$i =0;
		foreach($products as $product){
			foreach($product['Vary'] as $key => $vary){
				if($vary['sellable_qty'] != 0){
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i] = $product['Product'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['pv_id'] = $vary['id']; // pv_id variantID
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['variant'] = $vary['variant'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['sku'] = $vary['sku'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['barcode'] = $vary['barcode'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['price'] = $vary['price'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['metric'] = $vary['metric'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['size'] = $vary['variant'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['qty_type'] = $vary['qty_type'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['qty'] = $vary['qty'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['po_qty'] = $vary['po_qty'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['invoice_qty'] = $vary['sellable_qty'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['db_sold_qty'] = $vary['sold_qty'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['db_mfg_qty'] = $vary['mfg_return_qty'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['db_cr_qty'] = $vary['cr_qty'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['vendor'] = $product['Vendor']['name'];
					$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['category'] = $product['Category']['name'];
					if(isset($value)){
						$orderVar = $this->Vary->find('first',array('conditions' => array('Vary.var_id'=> $vary['id'],'Vary.po_no'=>$value),'fields' => array('Vary.id', 'Vary.price', 'Vary.quantity','Vary.price_total','Vary.po_no')));
							if(!empty($orderVar)){
								$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['price'] = !empty($orderVar) ? $orderVar['Vary']['price'] : '';
								$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['quantity'] = !empty($orderVar) ? $orderVar['Vary']['quantity'] : '';							//$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['qty'] = !empty($orderVar) ? $orderVar['Vary']['quantity'] : '';
								$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['sum'] = !empty($orderVar) ? $orderVar['Vary']['price_total'] : '';
								$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['po_no'] = !empty($orderVar) ? $orderVar['Vary']['po_no'] : '';
								$result[$product['Vendor']['name']][$product['Category']['name']]['Product'][$i]['ov_id'] = !empty($orderVar) ? $orderVar['Vary']['id'] : '';
								
								$result['totalQty']  += !empty($orderVar) ? $orderVar['Vary']['quantity'] : 0;
								$result['totalSum']  += !empty($orderVar) ? $orderVar['Vary']['price_total'] : 0.00;
								//$result['editVendor'] = $product['Vendor']['name'];
							}
						}
				$i++;
				}
			}
			
		}
		
		$this->set('products', $result);
		$this->set('_serialize', array('products'));
	}
	
	
	
	public function addSales() {
	    $this->layout = ''; 
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		$user = $this->Auth->user();
		if ($this->request->is('post')) {	
				$value = $this->request->data;
				$sale='SAL'.rand('111111','999999');
				$this->request->data['Sale']['user_id']= $user['id'];
				$this->request->data['Sale']['sales_no']=$sale;	
				$this->request->data['Sale']['total_quantity']=$value['cartQty'];
				$this->request->data['Sale']['total_price']=$value['cartSum'];
				$this->request->data['Sale']['status'] = 1;
				$this->Sale->create();
				if($this->Sale->save($this->request->data)) {
					  $i=0;
					  foreach ($value['items'] as $items){
							$options = array('conditions' => array('Vary.id' => $items['id']));
							$product = $this->Vary->find('first',$options);
							$this->request->data['Vary']['product_id'] = $items['p_id']; // variant product_id for the product table
							$this->request->data['Vary']['vendor_id'] = $items['vendor_id'];
							$this->request->data['Vary']['category_id'] = $items['category_id'];
							$this->request->data['Vary']['sold_qty'] = $items['sold_qty'];
							$this->request->data['Vary']['price'] = $items['price'];
							$this->request->data['Vary']['price_total'] = $items['price'] * $items['sold_qty'];	
							$this->request->data['Vary']['variant'] = $items['size'];	
							$this->request->data['Vary']['sku'] = $product['Vary']['sku'];
							$this->request->data['Vary']['metric'] = $product['Vary']['metric'];
							$this->request->data['Vary']['qty_type'] = $product['Vary']['qty_type'];
							$this->request->data['Vary']['qty'] = $product['Vary']['qty'];
							$this->request->data['Vary']['cr_qty'] = $items['cr_qty'];
							$this->request->data['Vary']['mfg_return_qty'] = $items['mfg_qty'];
							$this->request->data['Vary']['barcode'] = $product['Vary']['barcode'];
							$this->request->data['Vary']['var_id'] = $product['Vary']['id']; // variant id for the product in variant table
							$this->request->data['Vary']['type'] = 'sales';
							$this->request->data['Vary']['po_no'] = $sale;  
							$this->Vary->create();
							$this->Vary->save($this->request->data); 							
							$sales_qty = $product['Vary']['sold_qty']+$this->request->data['Vary']['sold_qty'];
							$cr_qty = $product['Vary']['cr_qty']+$this->request->data['Vary']['cr_qty'];
							$mfg_return_qty = $product['Vary']['mfg_return_qty']+$this->request->data['Vary']['mfg_return_qty'];
							$this->Vary->updateAll(array('Vary.sold_qty' => $sales_qty,'Vary.cr_qty' => $cr_qty,'Vary.mfg_return_qty' => $mfg_return_qty),array('Vary.product_id' => $this->request->data['Vary']['product_id'],'Vary.type' => 'product'));							
							$i++;
					 }
						 $responseCart = array('status'=>1,'orderID'=>$sale,'message'=>'Purchase Order Posted Successfully','response'=>'S');
				}else{
					$responseCart = array('message'=>'Unable To save Order','response'=>'E');
				}
		}else{
		   $responseCart = array('message'=>'Request Data is Incorrect','response'=>'E');
		}
	   $this->set(array('responseCart' => $responseCart,'_serialize' => array('responseCart')));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sale->save($this->request->data)) {
				$this->Flash->success(__('The sale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The sale could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
			$this->request->data = $this->Sale->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Sale->delete()) {
			$this->Flash->success(__('The sale has been deleted.'));
		} else {
			$this->Flash->error(__('The sale could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function cleartable(){
		$this->Order->query('TRUNCATE orders;');
		$this->Invoice->query('TRUNCATE invoices;');
		$this->Payment->query('TRUNCATE payments;');
		$this->Shipping->query('TRUNCATE shippings;');
		$this->Sale->query('TRUNCATE sales;');
		$this->Vary->unbindModel(array('belongsTo' => array('Product','Order')));
		$varies = $this->Vary->find('all',array('conditions'=>array('Vary.type !='=>'product'),'fields'=>'Vary.id'));
		foreach($varies as $vary){
			$this->Vary->id = $vary['Vary']['id'];
			$this->Vary->delete();
		}
		
		$this->Vary->updateAll(array('Vary.po_qty' => 0,'Vary.invoice_qty' => 0,'Vary.ship_qty' => 0,'Vary.unship_qty' => 0,'Vary.inb_qty' => 0,'Vary.inb_missing_qty' => 0,'Vary.inb_ship_missing_qty' => 0,'Vary.defect_qty' => 0,'Vary.sellable_qty' => 0,'Vary.sold_qty' => 0,'Vary.cr_qty' => 0,'Vary.mfg_return_qty' => 0,'Vary.unsellable_qty' => 0,'Vary.qty_lost' => 0),array('Vary.type' => 'product'));

		echo "Success"; exit;
 	}
}
