<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        //parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index(){
		
	}
	
    public function add(){
		if($this->request->is('post')){
			$this->request->data['Product']['user_id'] = $this->Auth->user('id');
			$this->Product->create();
			$this->Product->set(array(
				'outline' => $_POST['movieOutline']
			));
			if($this->Product->save($this->request->data())){
				
			}
		}
	}
}
?>