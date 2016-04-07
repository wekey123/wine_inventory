<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppHelper', 'View/Helper');
//App::uses('TimeHelper', 'View/Helper')
App::uses('User', 'Model');
App::uses('Product', 'Model');
App::uses('Vendor', 'Model');
App::uses('Category', 'Model');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class UtilHelper extends AppHelper {
	
	 public $helpers = array('Time','Number');
	 
	 private $invoiceTotalPrice;
	 private $PaymentDueAmount;
	 
	 private $invoiceTotalQty;
	 private $QtyLeft;
	 
	 public function dateFormat($stringdate) {
			//date_default_timezone_set('Asia/Kolkata');
            return $this->Time->format('M jS, Y h:i A',$stringdate, null,'Asia/Kolkata'); 
    }
	
	 public function dateOnlyFormat($stringdate) {
			//date_default_timezone_set('Asia/Kolkata');
            return $this->Time->format('M jS, Y ',$stringdate, null,'Asia/Kolkata'); 
    }
	
	public function currencyFormat($nubmer) {
            return $this->Number->currency($nubmer, 'USD');  
    }
	
	public function getUserdetails($id){

		 $model = new User();
		 if($id != ''){ 
		    return $model->find("first",array('conditions'=>array('User.id'=>$id)));
		 }else
		     return '';
	}
	
	public function getProductdetails($pid){
		 $model = new Product();
		 if($pid != ''){ 
		 	return $model->find("first",array('conditions'=>array('Product.id'=>$pid)));
		 }else
		     return '';
	}
	
	public function getVendorName($pid){
		 $model = new Vendor();
		 if($pid != ''){ 
		 	return $model->find("first",array('conditions'=>array('Vendor.id'=>$pid)));
		 }else
		     return '';
	}
	public function getVendorType($pid){
		 $model = new Category();
		 if($pid != ''){ 
		 	return $model->find("first",array('conditions'=>array('Category.id'=>$pid)));
		 }else
		     return '';
	}
	
	public function setInvoiceTotalPrice($invoiceTotalPrice){
		$this->invoiceTotalPrice = $invoiceTotalPrice;
	}
	
	public function setTotalAmountPayed($totalAmountPayed){
		$this->PaymentDueAmount = $this->invoiceTotalPrice - $totalAmountPayed;
	}
	
	public function getAmountDue(){
		return $this->PaymentDueAmount;
	}
	
	
	public function setInvoiceTotalQty($invoiceTotalQty){
		$this->invoiceTotalQty = $invoiceTotalQty;
	}
	
	public function setPayedQty($payedQty){
		$this->QtyLeft = $this->invoiceTotalQty - $payedQty;
	}
	
	public function getQtyLeft(){
		return $this->QtyLeft;
	}
}
