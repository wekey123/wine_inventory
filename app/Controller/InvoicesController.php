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
	public $uses = array('Invoice','Product','Vary','Category','Order','InvoiceColumn','Vendor');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
	public $layout = 'admin';
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Invoice->recursive = 0;
		//$this->Paginator->settings = array('fields' => array(''),'conditions'=>array(''),'order' => array('Invoice.created' => 'desc'));
		//debug($this->Paginator->paginate());
		$this->set('invoices', $this->Paginator->paginate(array(''),array('Invoice.created' => 'asc')));
		self::categoryList();
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
						$this->request->data['Vary']['metric'] = $value['metric'][$i];
						$this->request->data['Vary']['qty_type'] = $value['qty_type'][$i];
						$this->request->data['Vary']['qty'] = $value['qty'][$i];						
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
				 
				$this->Order->updateAll(array('Order.status' => 2),array('Order.po_no' => $this->request->data['Invoice']['po_no']));
					
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
		/*$orders = $this->Invoice->Order->find('all',array('conditions'=>array('Order.status'=>0),'fields'=>array('Order.po_no'),'group'=>'Order.po_no'));
		
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
		}*/
		
		self::categoryList();
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
			$this->request->data['Invoice']['invoice_date'] = date("Y-m-d", strtotime($this->request->data['Invoice']['invoice_date']));
			$this->request->data['Invoice']['estimated_shipping_date'] = date("Y-m-d", strtotime($this->request->data['Invoice']['estimated_shipping_date']));
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
				$pricetotal = 0;$allQuan = 0;
			  if(isset($this->request->data['Vary'])){
				$i=1;
				$value = $this->request->data['Vary'];
				  foreach($value['quantity']  as  $quan){
						$this->request->data['Vary']['product_id'] = $value['product_id'][$i];
						$this->request->data['Vary']['po_no'] = $this->request->data['Invoice']['invoice_no'];   
						$this->request->data['Vary']['quantity'] = $quan;
						$this->request->data['Vary']['variant'] = $value['variant'][$i];
						$this->request->data['Vary']['metric'] = $value['metric'][$i];
						$this->request->data['Vary']['qty_type'] = $value['qty_type'][$i];
						$this->request->data['Vary']['qty'] = $value['qty'][$i];
						$this->request->data['Vary']['sku'] = $value['sku'][$i];
						$this->request->data['Vary']['barcode'] = $value['barcode'][$i];
						$this->request->data['Vary']['price'] = $value['price'][$i];
						$this->request->data['Vary']['price_total'] = $value['price'][$i] * $quan;
						$pricetotal +=$value['price'][$i] * $quan;
						$allQuan += $quan;
						$this->request->data['Vary']['type'] = 'invoice';
						$this->request->data['Vary']['var_id'] = $value['var_id'][$i];
						$this->request->data['Vary']['id'] = isset($value['inv_id']) ? $value['inv_id'][$i] : '';
						$this->Vary->create();
						$this->Vary->save($this->request->data);
						$i++;
					}
				 
				$this->Order->updateAll(array('Order.status' => 2),array('Order.po_no' => $this->request->data['Invoice']['po_no']));
				$this->Invoice->updateAll(array('Invoice.total_price'=>$pricetotal,'Invoice.total_quantity'=>$allQuan),array('Invoice.id' => $id));	
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
		self::categoryList();
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
		 $this->viewPath = 'Elements';
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
	
	public function orderlist($value = null) {
		 $this->layout = '';
		 $this->autoRender = false ;
		 $no=$_POST['label'];
		 $options = array('conditions' => array('Order.vendor_id' => $no,'Order.status' => 1),'fields'=> array('Order.id','Order.po_no'));
		 $cat= $this->Order->find('all', $options);
		 if(!empty($cat)){
		 $val='<option value="">Select the Order</option>';
		 foreach($cat as $cate){
			 $val.='<option value="'.$cate['Order']['po_no'].'">'.$cate['Order']['po_no'].'</option>';
		 }
		 }else
		 $val='no';
		 return $val;
	}
	
	public function report($invoiceId = null,$page = null){
		$this->layout = null;
		$this->Invoice->bindModel(array('hasMany' => array('Vary' => array('foreignKey' => false,'conditions' => array('Vary.type' => 'invoice','Vary.po_no'=>$invoiceId)))),false);
		$options = array('conditions' => array('Invoice.invoice_no' => $invoiceId),'group' => 'Invoice.invoice_no');
		$Invoice = $this->Invoice->find('first',$options);
		$i =0;
		$total[1] = '';
		$total[2] = '';
		$total[3] = '';
		$total[4] = '';
		$total[5] = '';
		$total[6] = '';
		$total[7] = '';
		$total[8] = '';
		$total[9] = 0;
		$total[10] = '';
		$total[11] = 0.00;
		//$total[12] = 0.00;
			//debug($Invoice); exit;
			foreach($Invoice['Vary'] as $vary){
				$result[$vary['po_no']][$i]['SNO'] = $i+1;
				$ve_options = array('conditions' => array('Vendor.id' => $Invoice['Invoice']['vendor_id']));
				$vendor_array = $this->Vendor->find('first',$ve_options);
				//echo '<pre>';print_r($vendor_array);exit;
				$result[$vary['po_no']][$i]['VENDOR NAME'] = $vendor_array['Vendor']['name'];
				$result[$vary['po_no']][$i]['INVOICE NUMBER'] = $vary['po_no'];
				$result[$vary['po_no']][$i]['PO NUMBER'] = $Invoice['Invoice']['po_no'];
				$options = array('conditions' => array('Product.id' => $vary['product_id']));
				$product_array = $this->Product->find('first',$options);
				$result[$vary['po_no']][$i]['PRODUCT NAME'] = $product_array['Product']['title'];
				//$result[$vary['po_no']][$i]['CATEGORY NAME'] = $product_array['Product']['category_name'];
				$result[$vary['po_no']][$i]['SIZE'] = $vary['variant'];
				$result[$vary['po_no']][$i]['SKU'] = $vary['sku'];
				$result[$vary['po_no']][$i]['BARCODE'] = $vary['barcode'];
				$result[$vary['po_no']][$i]['QTY'] = $vary['quantity'];
				$price = number_format($vary['price'], 2, '.', '');
				$result[$vary['po_no']][$i]['PRICE'] = '$'.$price;
				$extended_price = number_format(($vary['quantity']*$price), 2, '.', '');
				$result[$vary['po_no']][$i]['EXTENDED PRICE'] = '$'.$extended_price;
				$total[9] += $vary['quantity'];
				$total[11] += number_format($extended_price, 2, '.', '');
				$i++;
			}
			
		$total[11] = '$'.number_format($total[11], 2, '.', '');
		//debug($result); exit;
		$this->set('data', $result);
		$this->set('totals', $total);
		$this->set('frompage',$page);
		$this->set('invoiceId',$invoiceId);
		$this->autoLayout = false;
		Configure::write('debug', '0');
	}
}
