<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property qComponent $q
 * @property SessionComponent $Session
 */
class DashboardController extends AppController {

/**
 * Components
 *
 * @var array
 */
 	public $uses = array('Vary');
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
		$count = array();
		$count['Product'] = $this->Vary->find('count',array('conditions'=>array('Vary.type'=>'product')));
		$count['Order'] = $this->Vary->find('count',array('conditions'=>array('Vary.type'=>'order'),'group'=> array('Vary.po_no')));
		$count['Invoice'] = $this->Vary->find('count',array('conditions'=>array('Vary.type'=>'invoice'),'group'=> array('Vary.po_no')));
		$count['Inventory'] = $this->Vary->find('count',array('conditions'=>array('Vary.type'=>'product','Vary.sellable_qty>0')));
		$this->set('Count',$count);
	}


}
