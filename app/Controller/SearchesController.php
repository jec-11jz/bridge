<?php
class SearchesController extends AppController {
	public $uses = array('Blog', 'User', 'Product');
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
		$count = 25;
		$page = 1;
		$keywords = null;
		$key_not = null;
		$key_or = null;
		$key_and = null;
		$contents = array();
		
		// deny access by post
		if($this->request->is('post')){
			return;
		}
		if(isset($this->request->query['keywords'])){
			$keywords = $this->request->query['keywords'];
		}
		if(!is_null($keywords)) {
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
		$count = 25;
		$page = 1;
		$keywords = null;
		$key_not = null;
		$key_or = null;
		$key_and = null;
		$contents = array();
		
		// deny access by post
		if($this->request->is('post')){
			$this->apiError('request is post');
			return;
		}
		
		if(isset($this->request->query['count'])) {
			$count = $this->request->query['count'];
		}
		
		if (isset($this->request->query['page'])) {
			$page = $this->request->query['page'];
		}

		// get param form view
		if(!empty($this->request->query['keywords'])){
			$keywords = $this->request->query['keywords'];
		}

		if(!is_null($keywords)) {
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
		if(empty($contents['blogs'])){
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
