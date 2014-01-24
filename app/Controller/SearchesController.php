<?php
class SearchesController extends AppController {
	public $uses = array('Blog', 'User', 'Product');
	
		public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('api_search', 'index');
    }
	
	public function index(){
		// show view
		// deny access by post
		if($this->request->is('post')){
			return;
		}
		if(isset($this->request->query['keywords'])){
			$condition = $this->request->query['keywords'];
		}
		$contents['keywords'] = $condition;
		if(isset($condition)){
			// GETされたデータを曖昧検索
			$contents['blogs'] = $this->Blog->find('all',
				array('conditions' => array('title like'=>'%'.$condition.'%')));
			$contents['product'] = $this->Product->find('all',
				array('conditions' => array('name like'=>'%'.$condition.'%')));
		} else {
			$contents['blogs'] = $this->Blog->find('all');
			$contents['product'] = $this->Product->find('all');
		}
		$this->set('data', $contents);
	}
	
	public function api_search() {
		$contents = array();
		// deny access by post
		if($this->request->is('post')){
			$this->apiError('request is post');
			return;
		}
		// get param form view
		if(isset($this->request->query['keywords'])){
			$condition = $this->request->query['keywords'];
		}
		if(isset($condition)){
			// GETされたデータを曖昧検索
			$contents['blogs'] = $this->Blog->find('all',
				array('conditions' => array('title like'=>'%'.$condition.'%',)));
			$contents['product'] = $this->Product->find('all',
				array('conditions' => array('name like'=>'%'.$condition.'%')));
		} else {
			$contents['blogs'] = $this->Blog->find('all');
			$contents['product'] = $this->Product->find('all');
		}
		if(!isset($contents)){
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
