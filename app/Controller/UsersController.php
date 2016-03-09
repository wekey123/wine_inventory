<?php
//include the 'class name ','keyword Controller'

App::uses('AppController', 'Controller');

class UsersController extends AppController {
	
	public $layout = 'admin';
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout');
		
		/*if (in_array($this->action, array('edit', 'delete'))) {
			$user_Id = (int) $this->request->params['pass'][0];
			if ($this->User->isOwnedBy($user_Id)) {
				 $user = $this->Auth->user();
				 parent::isAuthorized($user);
			}
		}*/
    }

	
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
		$user = $this->Auth->user();
		 $this->User->id = $id;
		if (($user['id'] == $id) || (isset($user['role']) && $user['role'] === 'admin')) {
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			$this->set('user', $this->User->findById($id));
		}else{
			$this->Flash->error($this->Auth->authError);
			return $this->redirect( array('controller' => 'users', 'action' => 'index'));
		}
    }

    public function add() {
		//Access Check Starts
		$user = $this->Auth->user();
		if(parent::isDeny($user)){
			$this->Flash->error($this->Auth->authError);
			return $this->redirect( array('controller' => 'users', 'action' => 'index'));
		}
		//Access Check end
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $user = $this->Auth->user();
		$this->User->id = $id;
		//if (($user['id'] == $id) || (isset($user['role']) && $user['role'] === 'admin')) {
		if (($user['id'] == $id)) {
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('The user has been saved'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(
					__('The user could not be saved. Please, try again.')
				);
			} else {
				$this->request->data = $this->User->findById($id);
				unset($this->request->data['User']['password']);
			}
		}else{
			$this->Flash->error("you can't access the private page of the other user");
			return $this->redirect( array('controller' => 'users', 'action' => 'index'));
		}
    }

    public function delete($id = null) {
		//Access Check Starts
		$user = $this->Auth->user();
		if(parent::isDeny($user)){
			$this->Flash->error($this->Auth->authError);
			return $this->redirect( array('controller' => 'users', 'action' => 'index'));
		}
		//Access Check end
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }


	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				/*$user = $this->Auth->user();
				if (isset($user['role']) && $user['role'] === 'author') {
					$this->Auth->loginRedirect = array('controller' => 'users','action' => 'view',$user['id']);
				}else{
					$this->Auth->loginRedirect = array('controller' => 'users','action' => 'index');
				}*/
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('Invalid username or password, try again');
		}
	}
	
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	

}