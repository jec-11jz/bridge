<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class BlogsController extends AppController {
	public $layout = 'menu';
	
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('index', 'add', 'view');
    }
	
	public function index() {
        // Modelから記事一覧を取得 ⇒ Viewへ送る
        $this->set('blogs', $this->Blog->find('all'));
	}
  
	 public function add() {
        // 以下は送信ボタンを押した後に実行される
        // HTTP POSTリクエストか確認
        if ($this->request->is('post')) {
            // 新規レコード生成
            $this->Blog->create();
            // フォームから受信したPOSTデータ
            if ($this->Blog->save($this->request->data)) {
                //メッセージを出力
                $this->Session->setFlash('記事を保存しました');
                // index.phpへリダイレクトBlog
                $this->redirect(array('controller' => 'home', 'action' => 'index'));
            } else {
                $this->Session->setFlash('記事を保存できません');
            }
        }
    }
    
    public function edit($id = null) {
        $this->User->id = $this->Auth->user('id');
		
		//ログイン中のユーザのIDからのユーザ情報を検索
        if ($data = $this->User->findById($this->Auth->user('id'))) {
	        if ($this->request->is('post') || $this->request->is('put')) {
	            if ($saved_data = $this->User->save($this->data, TRUE, array('nickname', 'email'))) {
	            	
					//セッション情報の更新
					$this->Session->write('Auth.User.nickname', $saved_data['User']['nickname']);
					$this->Session->write('Auth.User.email', $saved_data['User']['email']);
					
	                $this->Session->setFlash(__('更新完了です。 (｡･_･｡)ﾉ'));
					$this->redirect(array('action' => 'index'));
					
	            } else {
	                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
	            }
	        } else {
	            $this->request->data = $this->User->read(null, $id);
	            unset($this->request->data['User']['password']);
	        }
        } else {
        	$this->render('login');
        }
		

    }
    
    public function view($id = null) {
        // レコードを選択
        $this->Blog->id = $id;
        // レコードデータを取得しビューへ送る
        $this->set('blog', $this->Blog->read());
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
