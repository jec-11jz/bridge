<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class BlogsController extends AppController {
	public $uses = array('Blog', 'UsedBlogImage', 'User');
	public $layout = 'menu';
	
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        //parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index() {
        // Modelから記事一覧を取得 ⇒ Viewへ送る
        $blogs = $this->Blog->findAllByUserId($this->Auth->user('id'));
		$users = $this->User->findByName($this->Auth->user('name'));
		if (!is_array($blogs) && !empty($users)) {
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
		$this->set('blogs', $blogs);
		$this->set('users', $users);
	}
  
	 public function add() {
        // HTTP POSTリクエストか確認
        if ($this->request->is('post')) {
        	 $this->request->data['Blog']['user_id'] = $this->Auth->user('id'); 
            // 新規レコード生成
            $this->Blog->create();
            // フォームから受信したPOSTデータ
            $result = $this->Blog->save($this->request->data);
            if ($result) {
            	//imgタグのsrcをUsedBlogImageテーブルへ保存
            	$this->UsedBlogImage->saveFromHtml($this->Auth->user('id'), 
            		$result['Blog']['id'], 
            		$result['Blog']['content']
				);
                //メッセージを出力
                $this->Session->setFlash('記事を保存しました');
                // index.phpへリダイレクトBlog
                $this->redirect(array('controller' => 'blogs', 'action' => 'index'));
            } else {
                $this->Session->setFlash('記事を保存できません');
            }
        }
    }
    
    public function edit($id = null) {
    	
        if (!$id) {
        	throw new NotFoundException(__('Invalid post'));
    	}

	    $post = $this->Blog->findById($id);
	    if (!$post) {
	        throw new NotFoundException(__('Invalid post'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
	    	$this->Blog->id = $id;
			//編集前のUsedBlogImageのデータを削除する
			$this->UsedBlogImage->deleteAll(array('UsedBlogImage.blog_id'=>$id));
			//imgタグのsrcをUsedBlogImageテーブルへ保存
	    	$this->UsedBlogImage->saveFromHtml($this->Auth->user('id'), 
	    		$id, $this->request->data['Blog']['content']);
				
	        if ($this->Blog->save($this->request->data)) {
	            $this->Session->setFlash(__('Your post has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your post.'));
	    }
	
	    if (!$this->request->data) {
	        $this->request->data = $post;
	    }
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

        $post = $this->Blog->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    
    public function delete($id = null) {
    	$this->autoRender = false;
        // HTTP GETリクエストか確認
        if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            throw new MethodNotAllowedException();
        }
        if($this->Blog->delete($id)) {
            // 削除成功した場合はメッセージを出し、indexへリダイレクト
            $this->Session->setFlash('記事'. $id . 'を削除しました');
            $this->redirect(array('action' => 'index'));
        }
    }
}
