<?php
App::uses('AppController', 'Controller');
/**
 * Vendors Controller
 *
 * @property Vendor $Vendor
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class VendorsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	 public $uses = array('Vendor','Product','Category');
	public $components = array('Paginator', 'Flash', 'Session');
	public $layout = 'admin';
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Vendor->recursive = 0;
		$this->set('vendors', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vendor->exists($id)) {
			throw new NotFoundException(__('Invalid vendor'));
		}
		$options = array('conditions' => array('Vendor.' . $this->Vendor->primaryKey => $id));
		$this->set('vendor', $this->Vendor->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vendor->create();
			//debug($this->request->data); exit;
			if ($this->Vendor->save($this->request->data)) {
				
				foreach($this->request->data['Vendor']['Category'] as $categoryname){
					$this->request->data['Category']['vendor_id'] = $this->Vendor->getLastInsertId();
					$this->request->data['Category']['name'] = ucwords(strtolower($categoryname));
					$this->Category->create();
					$this->Category->save($this->request->data);
				}
				
				$this->Flash->success(__('The vendor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vendor could not be saved. Please, try again.'));
			}
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
		//Configure::write('debug', 0);
		if (!$this->Vendor->exists($id)) {
			throw new NotFoundException(__('Invalid vendor'));
		}
		if ($this->request->is(array('post', 'put'))) {
			//debug($this->request->data); exit;
			if ($this->Vendor->save($this->request->data)) {
				
				//to update Category
				if(!empty($this->request->data['Category'])){
					foreach($this->request->data['Category'] as  $category){
						$this->Category->id = $category['id'];
						$update['Category']['name'] = $category['name'];
						$this->Category->save($update);
	
					}
				}
				
				//to delete Category
				if(!empty($this->request->data['Delete'])){
					foreach($this->request->data['Delete'] as  $delete){
						$this->Category->id = $delete;
						$this->Category->delete();
					}
				}
				
				
				//add new category
				if(!empty($this->request->data['Vendor']['Category'])){
					foreach($this->request->data['Vendor']['Category'] as $categoryname){
						$this->request->data['Category']['vendor_id'] = $id;
						$this->request->data['Category']['name'] = ucwords(strtolower($categoryname));
						$this->Category->create();
						$this->Category->save($this->request->data);
					}
				}
				
				
				$this->Flash->success(__('The vendor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vendor could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vendor.' . $this->Vendor->primaryKey => $id));
			$this->request->data = $this->Vendor->find('first', $options);
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
		$this->Vendor->id = $id;
		if (!$this->Vendor->exists()) {
			throw new NotFoundException(__('Invalid vendor'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Vendor->delete()) {
			$this->Flash->success(__('The vendor has been deleted.'));
		} else {
			$this->Flash->error(__('The vendor could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
