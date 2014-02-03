<?php
class SearchesController extends AppController {
	public $uses = array('Blog', 'User', 'Product', 'Search', 'Tag', 'BlogsTag', 'ProductsTag', 'AttributesTag');
	public $components = array('RequestHandler');
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('api_search', 'index');
    }
	
	public function index(){
		// deny access by post
		if($this->request->is('post')){
			return;
		}
		
		// set default value
		$count = 10;
		$page = 1;
		$keywords = null;
		$key_tags = null;
		$contents = array();

		if(!empty($this->request->query['keywords'])){
			$keywords = $this->request->query['keywords'];
		}
		if(!empty($this->request->query['key_tags'])){
			$key_tags['keywords'] = $this->request->query['key_tags'];
			$key_tags['blog'] = $this->BlogsTag->getBlogIdFromCsvTags($key_tags['keywords']);
			$key_tags['product'] = $this->ProductsTag->getProductIdFromCsvTags($key_tags['keywords']);
			$attr_tags = $this->AttributesTag->getProductIdFromCsvTags($key_tags['keywords']);
			$key_tags['product'] = array_merge($key_tags['product'], $attr_tags);
		}
		// insert search result to contents
		$contents['blogs'] = $this->Blog->find('all',array(
			'conditions' => array(
				'Blog.status' => 0
			),
			'page' => $page,
			'limit' => $count
		));
		$contents['products'] = $this->Product->find('all',array(
			'page' => $page,
			'limit' => $count			
		));
		$nullCheck = $this->Search->nullCheckOfKeywords(
			array($keywords, $key_tags['keywords'])
		);
		if($nullCheck) {
			// set options
			$blog_options['page'] = $product_options['page'] = $page;
			$blog_options['limit'] = $product_options['limit'] = $count;
			$blog_options['conditions'] = array(
				'Blog.status' => 0,
				'OR' => array(
					'simplified_content like'=>'%'.$keywords.'%',
					'title like'=>'%'.$keywords.'%'
				)
			);
			$product_options['conditions'] = array(
				'OR' => array(
					'outline like'=>'%'.$keywords.'%',
					'name like'=>'%'.$keywords.'%'
				)
			);
			if(!is_null($key_tags['keywords'])){
				$blog_options['conditions']['Blog.id'] = $key_tags['blog'];
				$product_options['conditions']['Product.id'] = $key_tags['product'];
			}
			// search blogs
			$contents['blogs'] = $this->Blog->find('all', $blog_options);
			$contents['sql']['blogs'] = $this->Blog->getDataSource()->getLog();
			
			// search products
			$contents['products'] = $this->Product->find('all',$product_options);
			$contents['sql']['products'] = $this->Product->getDataSource()->getLog();
		}
		$contents['tags'] = $this->Search->mergeBlogTagsAndProductTags($contents);
		
		$this->set('data', $contents);
		$this->set('keyword', $keywords);
		$this->set('key_tags', $key_tags);
	}
	
	public function api_search() {
		// deny access by post
		if($this->request->is('post')){
			$this->apiError('request is post');
			return;
		}
		// set default value
		$count = 10;
		$page = 1;
		$keywords = null;
		$not_keywords = null;
		$key_tags['keywords'] = null;
		$not_key_tags['keywords'] = null;
		$contents = array();
		$countents['lastpage'] = null;
		
		if(!is_null($countents['lastpage'])){
			return $this->apiSuccess('最後のページです');
		}
		
		// get param form view
		if(isset($this->request->query['count'])) {
			$count = $this->request->query['count'];
		}
		if(isset($this->request->query['page'])) {
			$page = $this->request->query['page'];
		}
		if(!empty($this->request->query['keywords'])){
			$keywords = $this->request->query['keywords'];
		}
		if(!empty($this->request->query['not_keywords'])){
			$not_keywords = $this->request->query['not_keywords'];
		}
		if(!empty($this->request->query['key_tags'])){
			$key_tags['keywords'] = $this->request->query['key_tags'];
			$key_tags['blog'] = $this->BlogsTag->getBlogIdFromCsvTags($key_tags['keywords']);
			$key_tags['product'] = $this->ProductsTag->getProductIdFromCsvTags($key_tags['keywords']);
			$attr_tags = $this->AttributesTag->getProductIdFromCsvTags($key_tags['keywords']);
			$key_tags['product'] = array_merge($key_tags['product'], $attr_tags);
		}
		if(!empty($this->request->query['not_key_tags'])){
			$not_key_tags['keywords'] = $this->request->query['not_key_tags'];
			$not_key_tags['blog'] = $this->BlogsTag->getBlogIdFromCsvTags($not_key_tags['keywords']);
			$not_key_tags['product'] = $this->ProductsTag->getProductIdFromCsvTags($not_key_tags['keywords']);
			$not_attr_tags = $this->AttributesTag->getProductIdFromCsvTags($not_key_tags['keywords']);
			$not_key_tags['product'] = array_merge($not_key_tags['product'], $not_attr_tags);
		}
		
		// insert search result to contents
		$contents['blogs'] = $this->Blog->find('all',array(
			'conditions' => array(
				'Blog.status' => 0
			),
			'page' => $page,
			'limit' => $count
		));
		$contents['products'] = $this->Product->find('all',array(
			'page' => $page,
			'limit' => $count			
		));
		$nullCheck = $this->Search->nullCheckOfKeywords(
			array($keywords, $not_keywords, $key_tags['keywords'], $not_key_tags['keywords'])
		);
		if($nullCheck) {
			// set options
			$blog_options['page'] = $product_options['page'] = $page;
			$blog_options['limit'] = $product_options['limit'] = $count;
			$blog_options['conditions'] = array(
				'Blog.status' => 0,
				'OR' => array(
					'simplified_content like'=>'%'.$keywords.'%',
					'title like'=>'%'.$keywords.'%'
				)
			);
			$product_options['conditions'] = array(
				'OR' => array(
					'outline like'=>'%'.$keywords.'%',
					'name like'=>'%'.$keywords.'%'
				)
			);
			if(!is_null($key_tags['keywords'])){
				$blog_options['conditions']['Blog.id'] = $key_tags['blog'];
				$product_options['conditions']['Product.id'] = $key_tags['product'];
			}
			if (!is_null($not_keywords)) {
				$blog_options['conditions']['NOT'] = array(
					'simplified_content like'=>'%'.$not_keywords.'%',
					'title like'=>'%'.$not_keywords.'%'
				);
				$product_options['conditions']['NOT'] = array(
					'outline like'=>'%'.$not_keywords.'%',
					'name like'=>'%'.$not_keywords.'%'
				);
			}
			if(!is_null($not_key_tags['keywords'])){
				$blog_options['conditions']['NOT']['OR']['Blog.id'] = $not_key_tags['blog'];
				$product_options['conditions']['NOT']['OR']['Product.id'] = $not_key_tags['product'];
			}
			// search blogs
			$contents['blogs'] = $this->Blog->find('all', $blog_options);
			$contents['sql']['blogs'] = $this->Blog->getDataSource()->getLog();
			
			// search products
			$contents['products'] = $this->Product->find('all',$product_options);
			$contents['sql']['products'] = $this->Product->getDataSource()->getLog();
		}
		// get related tags
		$contents['tags'] = $this->Search->mergeBlogTagsAndProductTags($contents);
		// check last page
		$last_page = ceil((count($contents['blogs']) + count($contents['products'])) / $count);
		if($page == $last_page){
			$contents['lastpage'] = 'this page is last';
		}
		if(is_null($contents)){
			$this->apiError('contents are null');
			return;
		}
		
		$this->apiSuccess($contents);
	}
	
}

?>
