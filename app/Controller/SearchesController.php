<?php
class SearchesController extends AppController {
	public $uses = array('Blog', 'User', 'Product', 'Search', 'Tag');
	public $components = array('RequestHandler');
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('api_search', 'index');
    }
	
	public function index(){
		// set default value
		$count = 15;
		$page = 1;
		$keywords = null;
		$not_keywords = null;
		$not_key_tags = null;
		$key_tags = null;
		$contents = array();
		
		// deny access by post
		if($this->request->is('post')){
			return;
		}
		if(isset($this->request->query['keywords'])){
			$keywords = $this->request->query['keywords'];
		}
		if(!is_null(array($keywords))) {
			$contents['blogs'] = $this->Blog->find('all',array(
				'conditions' => array('title like'=>'%'.$keywords.'%'),
				'page' => $page,
				'limit' => $count
			));
			$contents['products'] = $this->Product->find('all',array(
				'conditions' => array('name like'=>'%'.$keywords.'%'),
				'page' => $page,
				'limit' => $count	
			));
		} else {
			$contents['blogs'] = $this->Blog->find('all',array(
				'page' => $page,
				'limit' => $count
			));
			$contents['products'] = $this->Product->find('all',array(
				'page' => $page,
				'limit' => $count			
			));
		}
		$this->set('data', $contents);
		$this->set('keyword', $keywords);
	}
	
	public function api_search() {
		// set default value
		$count = 15;
		$page = 1;
		$keywords = null;
		$not_keywords = null;
		$key_tags = null;
		$not_key_tags = null;
		$contents = array();
		
		// deny access by post
		if($this->request->is('post')){
			$this->apiError('request is post');
			return;
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
			$key_tags = $this->request->query['key_tags'];
			$key_tags = $this->Tag->parseTagCSV($key_tags);
		}
		if(!empty($this->request->query['not_key_tags'])){
			$not_key_tags = $this->request->query['not_key_tags'];
			$not_key_tags = $this->Tag->parseTagCSV($not_key_tags);
		}
		
		// insert search result to contents
		$contents['blogs'] = $this->Blog->find('all',array(
			'page' => $page,
			'limit' => $count
		));
		$contents['products'] = $this->Product->find('all',array(
			'page' => $page,
			'limit' => $count			
		));

		$nullCheck = $this->Search->nullCheckOfKeywords(array($keywords, $not_keywords, $key_tags, $not_key_tags));
		if($nullCheck) {
			// search blogs
			$contents['blogs'] = $this->Blog->find('all',array(
				'conditions' => array(
					'OR' => array(
						'simplified_content like'=>'%'.$keywords.'%',
						'title like'=>'%'.$keywords.'%'
					),
				),
				'page' => $page,
				'limit' => $count	
			));
			$contents['sql'] = $this->Blog->getDataSource()->getLog();
			
			$contents['products'] = $this->Product->find('all',array(
				'conditions' => array('name like'=>'%'.$keywords.'%'),
				'page' => $page,
				'limit' => $count	
			));
		}
		
		if(is_null($contents)){
			$this->apiError('contents are null');
			return;
		}
		
		$this->apiSuccess($contents);
	}
	
	public function test(){
		//リクエストがPOSTの場合
		if($this->request->is('post')){
			 //Formの値を取得
			 $condition = $this->request->data['Search']['condition'];
			 if(isset($condition)){
			 	
				//POSTされたデータを曖昧検索
				$data = $this->Blog->find('all',array(
			 		'conditions' => array('title like'=>'%'.$condition.'%')));
			 } else {
			 	$data = $this->Blog->find('all');
			 }
		} else {
			 //POST以外の場合
			 $data = $this->Blog->find('all');
			 
		}
		//データの連想配列をセット
		$this->set('blogs',$data);
	}
}

?>
