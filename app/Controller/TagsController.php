<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {
	public $layout = 'menu';
	
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index(){
		
	}
}
