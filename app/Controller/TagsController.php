<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {
	public $uses = array('Blog', 'UsedBlogImage', 'User', 'Tag', 'BlogsTag', 'ProductsTag');
	public $components = array('RequestHandler');

	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('api_search', 'api_get_most_used');
    }
	
	public function index(){
        $tags = $this->Tag->findAll();
		$this->set('tags', $tags);
	}

	public function api_index() {
		$tags = $this->Tag->find('all');
		$this->apiSuccess($tags);
	}
	
	public function add(){
		// HTTP POSTリクエストか確認
        if ($this->request->is('post')) {
        	if(!empty($this->request->data['Tag']['name'])){
	        	$user_id = $this->Auth->user('id'); 
				//送らてきたタグのカンマで区切られた文字列を分解す
				$tags = explode(",", $this->request->data['Tag']['name']);
				foreach ($tags as $tag) {
					$tag = trim($tag);
					if($this->Tag->findByName($tag)){
						//DBに存在するタグは登録しない
					} else {
						// 新規レコード生成
			            $this->Tag->create();
						$this->Tag->set(array('name'=>trim($tag), 'user_id'=>$user_id));
			            // フォームから受信したPOSTデータ
			            $this->Tag->save();
					}
				}
				//メッセージを出力
                $this->Session->setFlash(__('タグを登録しました'),'default', array(), 'tag');
				//ajaxで送られてきたか判断する
				if($this->request->is('ajax')) {
						$this->autoRender = false;
						$body['success'] = array(
							'message' => 'Success!!'
						);
						print json_encode($body);
						return;
				} else {
					return $this->redirect(array('controller' => 'tags', 'action' => 'index'));
				} 
        	}
            // index.phpへリダイレクトBlog
            print "error1";
            $this->redirect(array('controller' => 'tags', 'action' => 'index'));
        } else {
            $this->Session->setFlash(__('getRequest : タグを登録できませんでした'),'default', array(), 'tag');
        }
	}

	public function edit(){
		//ブログに付加されているタグを配列でViewに渡す
		$blogs = $this->Blog->findAllByUserId($this->Auth->User('id'));
		if(is_array($blogs)){
			//ユーザの使用しているタグを取得する
			$usedTagNames = $this->Blog->getTagNamesFromBlogs($blogs);
			if(is_array($usedTagNames)){
				$usedTagNames = implode(', ', $usedTagNames);
			}
		}
		
		 $this->set('tags', $usedTagNames);
	}

	public function api_get_most_used() {
		$tags = $this->Tag->getMostUsedTags();
		$this->apiSuccess($tags);
	}
	
	public function delete($id = null) {
    	$this->autoRender = false;
		$this->Session->setFlash(__('通過しました'),'default', array(), 'tag');
        // HTTP GETリクエストか確認
        if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            throw new MethodNotAllowedException();
        }
        if($this->Tag->delete($id)) {
            // 削除成功した場合はメッセージを出し、indexへリダイレクト
			$this->Session->setFlash(__('タグ'. $id . 'を削除しました'),'default', array(), 'tag');
            $this->redirect(array('action' => 'index'));
        }
    }
}
