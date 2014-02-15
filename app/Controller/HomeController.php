<?php

class HomeController extends AppController {
	public $components = array('RequestHandler');
	public $uses = array('Product', 'Blog', 'UsedBlogImage');
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('index', 'api_get_toppage_contents');
    }
	
	public function index()
	{
		// show index.ctp
	}
	public function create(){
		// show create.ctp
	}
	
	public function api_get_toppage_contents (){
		$toppage_contents = array();
		// new product
		$toppage_contents['newProduct'] = $this->Product->find('all',array(
				'order'=>array('Product.created DESC'),
				'limit' => 5,
		));
		// most popular product
		$toppage_contents['mostPopularProduct'] = $this->Product->find('all',array(
				'order'=>array('Product.name'),
				'limit' => 5,
		));
		// new blog
		$toppage_contents['newBlog'] = $this->Blog->find('all',array(
				'order'=>array('Blog.created DESC'),
				'limit' => 5,
		));
		// most popular product
		$toppage_contents['mostPopularBlog'] = $this->Blog->find('all',array(
				'order'=>array('Blog.title'),
				'limit' => 5,
		));
		
		if(!isset($toppage_contents)){
			$this->apiError('image not found');
		}
		$this->apiSuccess($toppage_contents);
	}
}

?>