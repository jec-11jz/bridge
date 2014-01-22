<?php

class HomeController extends AppController {
	
	public $uses = array('Product', 'blog');
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
		// $toppage_contents = array();
		// $toppage_contents['newProduct'] = $this->Product->find(array(
				// 'order'=>array('Product.created'),
				// 'limit' => 5,
		// ));
		// $this->set('toppage_contents', $toppage_contents);
	}
	
	public function api_get_toppage_contents (){
		$toppage_contents = array();
		$toppage_contents['newProduct'] = $this->Product->find(array(
				'order'=>array('Product.created'),
				'limit' => 5,
		));
		
		$this->set('toppage_contents', $toppage_contents);
	}
}

?>