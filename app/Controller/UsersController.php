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
		if ($this->request->is('post')) {
	      $this->User->save($this->request->data);
	    }
	}
}
