<?php

class HomeController extends AppController {
	
	
	public $layout = 'menu';
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('index');
    }
	
	public function index()
	{
		
	}
	
	public function test(){
		$this->layout = '';
	}
}

?>