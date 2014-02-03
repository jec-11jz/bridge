<?php
App::uses('AppController', 'Controller');

class BlogsController extends AppController {
    public $uses = array('Blog', 'UsedBlogImage', 'User', 'Tag', 'BlogTag');
	public $components = array('RequestHandler');
	
	
	public function beforeFilter()
    {
    	// 親クラス（AppController）読み込み
        parent::beforeFilter();
		// permitted access before login
        $this->Auth->allow('view', 'api_view', 'api_get_blog_info');
    }
	
	public function index()
	{
		// show view
	}

	public function api_index() {
		$count = 50;
		if(isset($this->request->query['count'])) {
			$count = $this->request->query['count'];
		}
		$page = 1;
		if (isset($this->request->query['page'])) {
			$page = $this->request->query['page'];
		}

		$blogs = $this->Blog->findAllByUserId(
			$this->Auth->user('id'),
			array(),
			array(),
			$count,
			$page
		);

		$this->apiSuccess(array('blogs' => $blogs));
	}

	public function add() {
		if (!$this->request->is('post')) {
			return;
		}

		$tagNames = $this->Tag->parseTagCSV($this->request->data['Tag']['name']);
		$this->Tag->saveFromNameArray($tagNames);
		$tags = $this->Tag->find('list', array(
			'conditions' => array(
				'Tag.name' => $tagNames,
			),
			'fields' => array('Tag.id')
		));
	
		
		$blogData = array('Blog' => $this->request->data['Blog']);
		$blogData['Blog']['simplified_content'] = html_entity_decode(strip_tags($this->request->data['Blog']['content']));
		$blogData['Blog']['user_id'] = $this->Auth->user('id');
		$blogData['Tag'] = $tags;
		$this->Blog->create();
		$result = $this->Blog->saveAll($blogData);
		if ($result) {
			//メッセージを出力
			$this->Session->setFlash('記事を保存しました');
			// index.phpへリダイレクト
			$this->redirect(array('controller' => 'searches', 'action' => 'index'));
		} else {
			$this->Session->setFlash('記事を保存できません');
		}
	}

    
    public function edit($id = null) {
        if (!$id) {
        	throw new NotFoundException(__('blog_id is not found'));
    	}
		//ブログが存在するかどうかを確かめる
	    $post = $this->Blog->findByIdAndUserId($id, $this->Auth->user('id'));
	    if (!$post) {
	        throw new NotFoundException(__('this blog is not exist'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$tagNames = $this->Tag->parseTagCSV($this->request->data['Tag']['name']);
			$this->Tag->saveFromNameArray($tagNames);
			$tags = $this->Tag->find('list', array(
				'conditions' => array(
					'Tag.name' => $tagNames,
				),
				'fields' => array('Tag.id')
			));
			$blogData = array('Blog' => $this->request->data['Blog']);
			$blogData['Blog']['id'] = $id;
			$blogData['Blog']['simplified_content'] = $value = html_entity_decode(strip_tags($this->request->data['Blog']['content']));
			$blogData['Blog']['user_id'] = $this->Auth->user('id');
			$blogData['Tag'] = $tags;
			$this->Blog->create();
			$result = $this->Blog->saveAll($blogData);
			if ($result) {
				$this->Session->setFlash('記事を保存しました');
				$this->redirect(array('controller' => 'searches', 'action' => 'index'));
			} else {
				$this->Session->setFlash('記事を保存できません');
			}
		}

		$post = $this->Blog->findByIdAndUserId($id, $this->Auth->user('id'));
		$post['Tag']['namesCSV'] = $this->Tag->tagNamesToCSV($post['Tag']);
		$this->set('post', $post);
    }

	public function api_get_blog_info(){
		$blog_id = null;
		$count = 10;
		if(!is_null($this->request->query['blog_id'])){
			$blog_id = $this->request->query['blog_id'];
		}
		
		$spoiler = $this->Blog->findById($blog_id);
		for($i = 0; $i < $count; $i++){
			$spoiler['Blog']['count'][] = $i;
		}
		$this->apiSuccess($spoiler['Blog']);
	}

	public function isAuthorized($user) {
	    // 登録済ユーザーは投稿できる
	    if ($this->action === 'add') {
	        return true;
	    }
	
	    // 投稿のオーナーは編集や削除ができる
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $postId = $this->request->params['pass'][0];
	        if ($this->Post->isOwnedBy($postId, $user['id'])) {
	            return true;
	        }
	    }
	    return parent::isAuthorized($user);
	}
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $blog = $this->Blog->findById($id);
        if (!$blog) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('blog', $blog);
	}

	public function api_view() {
		$id = null;
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		}
		$blog = $this->Blog->findById($id);
		if (!$blog) {
			$this->apiError('not found', 0, 404);
			return;
		}

		$this->apiSuccess($blog);
	}

    public function delete($id = null) {
    	$this->autoRender = false;
        // HTTP GETリクエストか確認
        if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            //throw new MethodNotAllowedException();
        }
        if($this->Blog->delete($id)) {
            // 削除成功した場合はメッセージを出し、indexへリダイレクト
            $this->Session->setFlash('記事'. $id . 'を削除しました');
            $this->redirect(array('controller' => 'searches', 'action' => 'index'));
        }
	}
}
