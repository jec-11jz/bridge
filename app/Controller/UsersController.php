<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends Controller {
	public function index() {
		
	}
	
	public function add() {

	}
	
	public function addCheck() {
		$this -> autoRender = false;
		$this->User->set($this->request->data);
		
		if($this->User->validates()){
			if ($this->request->is('post')) {
		      $this->User->save($this->request->data);
		    }
		} else {
			
		}
	}
}
