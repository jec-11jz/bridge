<?php
class ProductsController extends AppController {
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        //parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index()
	{
		
	}
	
	public function add(){
		
	}
}
?>