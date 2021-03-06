<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
 	public $uses = array('Product','Vary','Category');
	public $components = array('Paginator', 'Flash', 'Session' ,'Image','Auth');
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
		$this->Product->recursive = 0;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//Access Check Starts
		$user = $this->Auth->user();
		if(parent::isDeny($user)){
			$this->Flash->error($this->Auth->authError);
			return $this->redirect( array('controller' => 'products', 'action' => 'index'));
		}
		//Access Check end
		if ($this->request->is('post')) {
			$this->request->data['Product']['user_id'] = $user['id'];  
			$this->request->data['Product']['status'] = 1;
			//echo '<pre>';print_r($this->request->data);exit;
			if($this->request->data['Product']['image']['name'] != ''){
					$this->request->data['Product']['image'] = $this->request->data['Product']['image']!='' ? $this->Image->upload_image_and_thumbnail($this->request->data['Product']['image'],573,380,180,110, "product") : '';
				}
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$product_id = $this->Product->getLastInsertId();
				if(isset($this->request->data['Vary']['val'])){
				  foreach($this->request->data['Vary']['val']  as  $value){					  
					$this->request->data['Vary']['product_id'] = $product_id; 
					$this->request->data['Vary']['variant'] = $value['variant'];
					$this->request->data['Vary']['type'] = 'product';
					$this->request->data['Vary']['price'] = $value['price'];
					$this->request->data['Vary']['sku'] = $value['sku'];
					$this->request->data['Vary']['barcode'] = $value['barcode'];					
					$this->Vary->create();
					$this->Vary->save($this->request->data);
				  }
				}
				$this->Flash->success(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The product could not be saved. Please, try again.'));
			}
		}
		else{
			self::categoryList();
		}
		
	}

	private function categoryList(){
		$options = array('conditions' => array('Category.status' => 1),'fields'=> array('Category.id','Category.name'));
		$category= $this->Category->find('all', $options);
		foreach($category as $key => $values) {
			$value[$values['Category']['name']]= $values['Category']['name'];
		}
		$this->set('category', $value);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		//Access Check Starts
		$user = $this->Auth->user();
		if(parent::isDeny($user)){
			$this->Flash->error($this->Auth->authError);
			return $this->redirect( array('controller' => 'products', 'action' => 'index'));
		}
		//Access Check end
		
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['Product']['user_id'] = $user['id'];
			if($this->request->data['Product']['image']['name'] != ''){
				$this->request->data['Product']['image'] = $this->request->data['Product']['image']!='' ? $this->Image->upload_image_and_thumbnail($this->request->data['Product']['image'],573,380,180,110, "product") : '';
			}else{
			$this->request->data['Product']['image']=$this->request->data['Product']['image_edit'];
			}
			if ($this->Product->save($this->request->data)) {
				if(isset($this->request->data['Vary']['val'])){
				  foreach($this->request->data['Vary']['val']  as  $value){
					if($value['id'])
					$this->request->data['Vary']['id'] = $value['id'];    
					$this->request->data['Vary']['product_id'] = $id;  
					$this->request->data['Vary']['variant'] = $value['variant'];
					$this->request->data['Vary']['price'] = $value['price'];
					$this->request->data['Vary']['sku'] = $value['sku'];
					$this->request->data['Vary']['barcode'] = $value['barcode'];					
					$this->Vary->create();
					$this->Vary->save($this->request->data);
				  }
				}
				
				$this->Flash->success(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
			self::categoryList();
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
		//Access Check Starts
		$user = $this->Auth->user();
		if(parent::isDeny($user)){
			$this->Flash->error($this->Auth->authError);
			return $this->redirect( array('controller' => 'products', 'action' => 'index'));
		}
		//Access Check end

		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Flash->success(__('The product has been deleted.'));
		} else {
			$this->Flash->error(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
