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
        $this->Auth->allow('view', 'api_view');
    }
	
	public function index()
	{
		
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
		$blogData['Blog']['user_id'] = $this->Auth->user('id');
		$blogData['Tag'] = $tags;
		$this->Blog->create();
		$result = $this->Blog->saveAll($blogData);
		if ($result) {
			//メッセージを出力
			$this->Session->setFlash('記事を保存しました');
			// index.phpへリダイレクト
			$this->redirect(array('controller' => 'blogs', 'action' => 'index'));
		} else {
			$this->Session->setFlash('記事を保存できません');
		}
	}

	public function api_add() {
		if (!$this->request->is('post')) {
			$this->apiError('http method is not "POST"');
		}

		$this->Tag->saveFromNameArray($this->request->data['Tag']);
		$tags = $this->Tag->find('list', array(
			'conditions' => array(
				'Tag.name' => $this->request->data['Tag']
			),
			'fields' => array('Tag.id')
		));
		$blogData = array('Blog' => $this->request->data['Blog']);
		$blogData['Blog']['user_id'] = $this->Auth->user('id');
		$blogData['Tag'] = $tags;
		$this->Blog->create();
		$result = $this->Blog->saveAll($blogData);
		if ($result) {
			$this->apiSuccess(array('message' => 'save success'));
			return;
		}

		if ($this->Blog->validationErrors) {
			$this->apiValidationError('Blog', $this->Blog->validationErrors);
		} else {
			$this->apiError('add error');
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

		if ($this->request->is('post')) {
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
			$blogData['Blog']['user_id'] = $this->Auth->user('id');
			$blogData['Tag'] = $tags;
			$this->Blog->create();
			$result = $this->Blog->saveAll($blogData);
			if ($result) {
				$this->Session->setFlash('記事を保存しました');
			} else {
				$this->Session->setFlash('記事を保存できません');
			}
		}

		$post = $this->Blog->findByIdAndUserId($id, $this->Auth->user('id'));
		$post['Tag']['namesCSV'] = $this->Tag->tagNamesToCSV($post['Tag']);
		$this->set('post', $post);
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
            $this->redirect(array('action' => 'index'));
        }
	}
}
