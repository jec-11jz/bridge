<?php
App::uses('AppController', 'Controller');

class BlogsController extends AppController {
    public $uses = array('Blog', 'UsedBlogImage', 'User', 'Tag', 'BlogsTag', 'BlogsFavorite', 'Comment');
	public $components = array('RequestHandler');
	
	
	public function beforeFilter()
    {
    	// 親クラス（AppController）読み込み
        parent::beforeFilter();
		// permitted access before login
        $this->Auth->allow('view', 'api_view', 'api_get_blog_info', 'api_add_favorites', 'api_get_user_blogs', 'api_comment', 'api_add_count');
    }
	
	public function index()
	{
		// show view
		$user_info = $this->User->findById($this->Auth->user('id'));
		$this->set('user_info', $user_info);
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
		$sort = 'created_DESC';
		if (isset($this->request->query['sort'])) {
			$sort = $this->request->query['sort'];
		}
		if($sort == 'created_DESC'){
			$sort_key = 'created';
			$order = 'DESC';
		}
		
		$blogs = $this->Blog->findAllByUserId(
			$this->Auth->user('id'),
			array(),
			array('Blog.'),
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

	public function api_get_user_blogs(){
		$user_id = null;
		$blog_info = null;
		if(!empty($this->request->query['user_id'])){
			$user_id = $this->request->query['user_id'];
		}

		$blog_info['No'] = $this->Blog->findAllByUserId($user_id, 
			array(), 
			array('Blog.created'=>'desc')
		);
		
		return $this->apiSuccess($blog_info);
	}
	
	public function api_add_count() {
		$this->autoRender = false;
		$blog = $this->Blog->findById($this->request->data);
		if($this->Auth->user('id') == $blog['Blog']['user_id']){
			return;
		}
		$this->Blog->id = $this->request->data;
		$this->Blog->set(array('access_count'=>$blog['Blog']['access_count'] + 1));
		$this->Blog->save();
		return;
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
		if(!is_null($this->Auth)){
			$blog['login_user'] = $this->Auth->user();
		} else {
			$blog['login_user'] = null;
		}
        $this->set('blog', $blog);
	}

	public function api_view() {
		$blog_id = null;
		if(isset($this->request->query['id'])) {
			$blog_id = $this->request->query['id'];
		}
		$blog = $this->Blog->findById($blog_id);
		if(is_null($this->Auth)){
			$blog['auth'] = null;
		} else if($blog['Blog']['user_id'] == $this->Auth->user('id')){
			$blog['auth'] = 'author';
		} else {
			$blog['auth'] = 'another';
		}
		if (!$blog) {
			$this->apiError('not found', 0, 404);
			return;
		}
		$fav = $this->BlogsFavorite->findByUserIdAndBlogId($this->Auth->user('id'), $blog_id);
		if(empty($fav)){
			$blog['favorite'] = null;
		} else {
			$blog['favorite'] = $fav;
		}
	
		
		$this->apiSuccess($blog);
	}
	
	public function api_add_favorites() {
		$blog_id = null;
		$user_id = null;
		if(!empty($this->request->data['blog_id'])){
			$blog_id = $this->request->data['blog_id'];
		}
		
		if(is_null($blog_id)){
			return $this->apiError('ブログが存在しません');
		}
		if(is_null($this->Auth)){
			return $this->apiError('ログインしてください');
		}
		$user_id = $this->Auth->user('id');
		$message = $this->BlogsFavorite->saveUsersBlogs($blog_id, $user_id);
		
		return $this->apiSuccess($message);
	}
	
	public function api_delete_favorite(){
		$blog_id = null;
		$user_id = null;
		
		if(!empty($this->request->data['blog_id'])){
			$blog_id = $this->request->data['blog_id'];
		}
		if(is_null($blog_id)){
			return $this->apiError('ブログが存在しません');
		}
		if(is_null($this->Auth)){
			return $this->apiError('ログインしてください');
		}
		
		$user_id = $this->Auth->user('id');
		$fav = $this->BlogsFavorite->findByUserIdAndBlogId($user_id, $blog_id);
		$result = $this->BlogsFavorite->Delete($fav['BlogsFavorite']['id']);
		
		if($result) {
			$message = '解除しました';
		} else {
			$message = '削除エラー';
		}
		
		return $this->apiSuccess($message);
	}
	
	public function api_comment() {
		$comment = array();
		$message = null;
		if(!empty($this->request->data)){
			$comment = $this->request->data;
		}
		if(!is_null($this->Auth)){
			$comment['author_id'] = $this->Auth->user('id');
		}
		$message = $this->Comment->saveComment($comment);
		
		$this->apiSuccess($message);
	}

    public function delete($id = null) {
    	$this->autoRender = false;
        // HTTP GETリクエストか確認
        if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            //throw new MethodNotAllowedException();
        }
        if($this->Blog->delete($id, $cascade = true)) {
   	        // 削除成功した場合はメッセージを出し、indexへリダイレクト
            $this->Session->setFlash('記事'. $id . 'を削除しました');
            $this->redirect(array('controller' => 'searches', 'action' => 'index'));
        }
	}
}
