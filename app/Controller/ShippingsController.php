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
	public $uses = array('Shipping','Payment','Invoice','Product','Vary','Category','Order','Vendor');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Vary->updateAll(array('Vary.ship_qty' => 0,'Vary.unship_qty' => 0,'Vary.inb_qty' => 0,'Vary.inb_ship_missing_qty' => 0,'Vary.defect_qty' => 0,'Vary.sellable_qty' => 0),array('Vary.type' => 'product'));exit;
		$this->Shipping->recursive = 0;
		$this->Paginator->settings = array('fields' => array(
        'po_no',
		'invoice_no',
		'shipping_method',
		'received_date',
		'total_ship_qty',
		'total_invoice_qty',
		'total_inb_qty',
		'total_sellable_qty',
		'total_inb_ship_missing_qty',
		'total_defect_qty',
		'user_id',
		'vendor_id',
		'status',
		'id'
    ),'group' => 'po_no','order' => array('created' => 'DESC'));
	//echo '<pre>';print_r($this->Paginator->paginate());exit;
		$this->set('shippings', $this->Paginator->paginate());
		self::vendorList();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		
		$this->Shipping->recursive = 1;
		$this->Shipping->bindModel(array(
            'hasMany' => array(
                'Vary' => array('foreignKey' => false,
                                    'conditions' => array('Vary.type' => 'shipping','Vary.po_no'=>$id)
                                )
                            )
                ),
            false
        );
		$options = array('conditions' => array('Shipping.invoice_no' => $id));
		$this->set('shipping', $shipping=$this->Shipping->find('first', $options));
		//echo '<pre>';print_r($shipping);exit;
		$total=array('');
		$total=array('ship_qty'=>0,'unship_qty'=>0,'inb_qty'=>0,'inb_ship_missing_qty'=>0,'defect_qty'=>0,'sellable_qty'=>0,'ship_qty'=>0,'invoice_quantity'=>0);
		//$total['shipping_quantity']=0;
		foreach($shipping['Vary'] as $ship){
			//$total['weight']+=$ship['Shipping']['weight'];
			
			$total['invoice_quantity']+=$ship['invoice_qty'];
			$total['ship_qty']+=$ship['ship_qty'];
			$total['unship_qty']+=$ship['unship_qty'];
			$total['inb_qty']+=$ship['inb_qty'];
			$total['inb_ship_missing_qty']+=$ship['inb_ship_missing_qty'];
			$total['defect_qty']+=$ship['defect_qty'];
			$total['sellable_qty']+=$ship['sellable_qty'];
			$total['po_no']=$ship['po_no'];
			$total['invoice_no']=$id;
		}
		$this->set('test', $total);
		//echo '<pre>';print_r($total);exit;
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Auth->user();
		if ($this->request->is('post')) {
			//echo '<pre>';print_r($this->request->data);exit;
			$this->request->data['Shipping']['user_id']= $user['id'];
			$this->request->data['Shipping']['received_date'] = date("Y-m-d", strtotime($this->request->data['Shipping']['received_date']));
			if(isset($this->request->data['Vary'])){
				$i=1;$total_inv_qty=0;
				  foreach($this->request->data['Vary']  as  $value){
					  
						 $varoptions = array('conditions' => array('Vary.id' => $value['prod_var_id']));
						 $varproduct = $this->Vary->find('first',$varoptions);

						 $ship_qty = $varproduct['Vary']['ship_qty'] ;
						 $unship_qty = $varproduct['Vary']['unship_qty'] ;
						 $inb_qty = $varproduct['Vary']['inb_qty'] ;
						 $inb_ship_missing_qty = $varproduct['Vary']['inb_ship_missing_qty'] ;
						 $defect_qty = $varproduct['Vary']['defect_qty'];
						 $sellable_qty = $varproduct['Vary']['sellable_qty'] ;
						 
						 $iq= $value['invoice_quantity'] ;
						 $sq= $value['ship_qty'] ;
						 $inbq= $value['inb_qty'];
						 $dq=$value['defect_qty'];
						
						$value['user_id'] = $user['id'];
						$value['quantity'] = $sq;
						$value['ship_qty'] = $sq;
						$value['unship_qty'] = $iq-$sq;
						$value['inb_qty'] = $inbq;
						$value['inb_ship_missing_qty'] = $sq-$inbq;
						$value['defect_qty'] = $dq;
						$value['sellable_qty'] = $inbq-$dq;
						$value['invoice_qty'] = $iq;
						$this->Vary->create();
						$this->Vary->save($value);
						
						if($this->request->data['submit'] == 'Save and Add to Sale'){
						$this->Vary->updateAll(array('Vary.ship_qty' => $ship_qty+$sq,'Vary.unship_qty' => $unship_qty+($iq-$sq),'Vary.inb_qty' => $inb_qty+$inbq,'Vary.inb_ship_missing_qty' => $inb_ship_missing_qty+($sq-$inbq),'Vary.defect_qty' => $defect_qty+$dq,'Vary.sellable_qty' => $sellable_qty+($inbq-$dq)),array('Vary.id' => $value['prod_var_id'],'Vary.type' => 'product'));
						$this->request->data['Shipping']['status'] = 1;
						}else
						$this->request->data['Shipping']['status'] = 0;
						
					    $this->request->data['Shipping']['total_ship_qty'] += $sq;
						$this->request->data['Shipping']['total_unship_qty'] += $value['unship_qty'];
						$this->request->data['Shipping']['total_inb_qty'] += $inbq;
						$this->request->data['Shipping']['total_inb_ship_missing_qty'] += $value['inb_ship_missing_qty'];
						$this->request->data['Shipping']['total_defect_qty'] += $dq;
						$this->request->data['Shipping']['total_sellable_qty'] += $value['sellable_qty'];
						$this->request->data['Shipping']['total_invoice_qty'] += $value['invoice_qty'];
						$total_inv_qty += $iq;
						$i++;
					}//exit;
					$this->Shipping->create();
					if ($this->Shipping->save($this->request->data)) {
						if($total_inv_qty==$this->request->data['Shipping']['total_ship_qty']){
						$this->Invoice->updateAll(array('Invoice.status' => 4),array('Invoice.invoice_no' => $this->request->data['Shipping']['invoice_no']));
						$this->Order->updateAll(array('Order.status' => 5),array('Order.po_no' => $this->request->data['Shipping']['po_no']));
						//$this->request->data['Shipping']['status']= 3;
						}
						else{
						$this->Invoice->updateAll(array('Invoice.status' => 4),array('Invoice.invoice_no' => $this->request->data['Shipping']['invoice_no']));
						$this->Order->updateAll(array('Order.status' => 5),array('Order.po_no' => $this->request->data['Shipping']['po_no']));
						//$this->request->data['Shipping']['status']= 2;
						}
					}
			
				$this->Flash->success(__('The shipping has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				//debug($this->Shipping->validationErrors);
				$this->Flash->error(__('The shipping could not be saved. Please, try again.'));return $this->redirect(array('action' => 'index'));
			}
		}else{
			$invoices = $this->Invoice->find('all',array('conditions'=>array('Invoice.status'=>array(0,1,2,3,4)),'fields'=>array('Invoice.invoice_no'),'group'=>'Invoice.invoice_no'));
			foreach($invoices as $invoice){
				$invoicelist[]=$invoice['Invoice']['invoice_no'];
			}
			$this->set(compact('invoicelist'));
			
			self::vendorList();
			
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
		$user = $this->Auth->user();
		//$this->Vary->updateAll(array('Vary.ship_qty' => 0,'Vary.unship_qty' => 0,'Vary.inb_qty' => 0,'Vary.inb_ship_missing_qty' => 0,'Vary.defect_qty' => 0,'Vary.sellable_qty' => 0),array('Vary.type' => 'product'));exit;
		if ($this->request->is(array('post', 'put'))) {
			//echo '<pre>';print_r($this->request->data);exit;
			if(isset($this->request->data['Vary'])){
				$i=1;$total_inv_qty=0;
				$this->request->data['Shipping']['total_ship_qty']=0;$this->request->data['Shipping']['total_unship_qty']=0;
				$this->request->data['Shipping']['total_inb_qty']=0;$this->request->data['Shipping']['total_inb_ship_missing_qty']=0;
				$this->request->data['Shipping']['total_defect_qty']=0;$this->request->data['Shipping']['total_sellable_qty']=0;
				  foreach($this->request->data['Vary']  as  $value){
					
					
					 $varoptions = array('conditions' => array('Vary.id' => $value['prod_var_id']));
					 $varproduct = $this->Vary->find('first',$varoptions);
					 
					 // For update the variant type product row on old quantity
					 
					 /*$ship_qty = $varproduct['Vary']['ship_qty']-$value['old_ship_qty'] ;
					 $unship_qty = $varproduct['Vary']['unship_qty']-$value['old_unship_qty'] ;
					 $inb_qty = $varproduct['Vary']['inb_qty']- $value['old_inb_qty'] ;
					 $inb_ship_missing_qty = $varproduct['Vary']['inb_ship_missing_qty']-$value['old_inb_ship_missing_qty'] ;
					 $defect_qty = $varproduct['Vary']['defect_qty']-$value['old_defect_qty'];
					 $sellable_qty = $varproduct['Vary']['sellable_qty']-$value['old_sellable_qty'] ;
					 $type_ids = $value['prod_var_id'] ;*/
					 
					 
					 $ship_qty = $varproduct['Vary']['ship_qty'];
					 $unship_qty = $varproduct['Vary']['unship_qty'];
					 $inb_qty = $varproduct['Vary']['inb_qty'];
					 $inb_ship_missing_qty = $varproduct['Vary']['inb_ship_missing_qty'];
					 $defect_qty = $varproduct['Vary']['defect_qty'];
					 $sellable_qty = $varproduct['Vary']['sellable_qty'];
					 $type_ids = $value['prod_var_id'] ;
					 
					 $sq= $value['ship_qty'] ;
					 $iq= $value['invoice_quantity'] ;
					 $inbq= $value['inb_qty'];
					 $dq=$value['defect_qty'];
					
						if($this->request->data['submit'] == 'Save and Add to Sale'){
						$this->Vary->updateAll(array('Vary.ship_qty' => $ship_qty+$sq,'Vary.unship_qty' => $unship_qty+($iq-$sq),'Vary.inb_qty' => $inb_qty+$inbq,'Vary.inb_ship_missing_qty' => $inb_ship_missing_qty+($sq-$inbq),'Vary.defect_qty' => $defect_qty+$dq,'Vary.sellable_qty' => $sellable_qty+($inbq-$dq)),array('Vary.id' => $type_ids,'Vary.type' => 'product'));
						$this->request->data['Shipping']['status'] = 1;
						}else
						$this->request->data['Shipping']['status'] = 0;
						
						$this->request->data['Vary']['ship_qty'] = $sq;
						$this->request->data['Vary']['unship_qty'] = $iq-$sq;
						$this->request->data['Vary']['inb_qty'] = $inbq;
						$this->request->data['Vary']['inb_ship_missing_qty'] = $sq-$inbq;
						$this->request->data['Vary']['defect_qty'] = $dq;
						$this->request->data['Vary']['sellable_qty'] = $inbq-$dq;
						$this->request->data['Vary']['id'] = isset($value['edit_var_id']) ? $value['edit_var_id'] : '';
						$this->Vary->save($this->request->data);
						
					    $this->request->data['Shipping']['total_ship_qty'] += $sq;
						$this->request->data['Shipping']['total_unship_qty'] += $this->request->data['Vary']['unship_qty'];
						$this->request->data['Shipping']['total_inb_qty'] += $inbq;
						$this->request->data['Shipping']['total_inb_ship_missing_qty'] += $this->request->data['Vary']['inb_ship_missing_qty'];
						$this->request->data['Shipping']['total_defect_qty'] += $dq;
						$this->request->data['Shipping']['total_sellable_qty'] += $this->request->data['Vary']['sellable_qty'];
						$total_inv_qty += $iq;
						$i++;
						//unset($varproduct);
					}
					//$this->Shipping->create();
					if ($this->Shipping->save($this->request->data)) {
						if($total_inv_qty==$this->request->data['Shipping']['total_ship_qty']){
						$this->Invoice->updateAll(array('Invoice.status' => 4),array('Invoice.invoice_no' => $this->request->data['Shipping']['invoice_no']));
						$this->Order->updateAll(array('Order.status' => 5),array('Order.po_no' => $this->request->data['Shipping']['po_no']));
						//$this->request->data['Shipping']['status']= 3;
						}
						else{
						//For Multiple Shipping Change the Invoice Status
						$this->Invoice->updateAll(array('Invoice.status' => 4),array('Invoice.invoice_no' => $this->request->data['Shipping']['invoice_no']));
						$this->Order->updateAll(array('Order.status' => 5),array('Order.po_no' => $this->request->data['Shipping']['po_no']));
						//$this->request->data['Shipping']['status']= 2;
						}
					}
			
				$this->Flash->success(__('The shipping has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
		} else {
			$options = array('conditions' => array('Shipping.invoice_no'=> $id));
			$this->request->data = $this->Shipping->find('first', $options);
			 $this->Invoice->bindModel(array(
				'hasMany' => array(
					'Vary' => array('foreignKey' => false,
										'conditions' => array('Vary.po_no'=>$id)
									)
								)
					),
				false
			);
			 $options = array('conditions' => array('Invoice.invoice_no' => $id));
			 $ordInv=$this->Invoice->find('first', $options);
			 $i=0;
			 //echo '<pre>';print_r($ordInv);exit;
			foreach($ordInv['Vary'] as $invCount){
				if($invCount['type']=='invoice'){
					$pall= self::in_array_r($invCount['id'], $ordInv['Vary']);
					 $ordInv['Vary'][$i]['ship_qty']= $pall['ship_qty'];
					 $ordInv['Vary'][$i]['unship_qty']= $pall['unship_qty'];
					 $ordInv['Vary'][$i]['inb_qty']= $pall['inb_qty'];
					 $ordInv['Vary'][$i]['inb_ship_missing_qty']= $pall['inb_ship_missing_qty'];
					 $ordInv['Vary'][$i]['defect_qty']= $pall['defect_qty'];
					 $ordInv['Vary'][$i]['sellable_qty']= $pall['sellable_qty'];
					 $ordInv['Vary'][$i]['inv_id']= $pall['id'];
				}
			$i++;
			}
			$this->set('invoice', $ordInv);
			//echo '<pre>';print_r($ordInv);exit;
		  //$this->set('order', $ordInv);
			
			//echo '<pre>';print_r($this->Invoice->find('first', $options));exit;
		}
		$invoices = $this->Shipping->Invoice->find('list');
		$this->set(compact('invoices'));
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
	
	
	public function ajax($value = null) {
		 $this->layout = '';
		 $this->autoRender = false ;
		 $this->viewPath = 'Elements';
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
		 //echo '<pre>';print_r($this->Invoice->find('first', $options));exit;
		 $this->render('shipping');
	}
	
	private function vendorList(){
		$vendors1= $this->Vendor->find('all');
		//$vendor[0] = 'Select Vendor';
		foreach($vendors1 as $key => $vendors) {
			if(isset($vendors['Category'][0]))
			$vendor[$vendors['Vendor']['id']]= $vendors['Vendor']['name'];
		}
		$this->set('vendor', $vendor);
		
	}
	
	public function invoicelist($value = null) {
		 $this->layout = '';
		 $this->autoRender = false ;
		 $no=$_POST['label'];
		 $options = array('conditions' => array('Invoice.vendor_id' => $no,'Invoice.status' => array(0,1,2,3)),'fields'=> array('Invoice.id','Invoice.invoice_no'));
		 $cat= $this->Invoice->find('all', $options);
		 if(!empty($cat)){
		 $val='<option value="">Select the Invoice</option>';
		 foreach($cat as $cate){
			 $val.='<option value="'.$cate['Invoice']['invoice_no'].'">'.$cate['Invoice']['invoice_no'].'</option>';
		 }
		 }else
		 $val='no';
		 return $val;
	}

}
