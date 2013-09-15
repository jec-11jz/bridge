<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	
	//モデルの指定
	public $uses = array('User');
	//コンポーネントの設定
	public $components = array(
            'Session',
            'Auth' => array(
            	//ログイン後のリダイレクト先
                'loginRedirect' => array('controller'  => 'users', 'action' => 'done'),
                //ログアウト後のリダイレクト先
                'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
                //ログインしていない場合のリダイレクト先
                'loginAction' => array('controller' => 'users', 'action' => 'login'),
                //ログインにデフォルトの username ではなく email を使うためここで書き換えています
                'authenticate' => array('Form' => Array('fields' => array('username' => 'id'),
														'Basic' => array('userModel' => 'Member'),
										    			'Form' => array('userModel' => 'Member'),
														'passwordHasher' => 'Blowfish'))
            )
    );
	
	//ログイン認証前にアクセスできるアクション
	public function beforeFilter()
    {
        parent::beforeFilter();
		//ログイン認証前にアクセスできるアクション
        $this->Auth->allow('add', 'login', 'index', 'done', 'edit');
    }

	public function index() {
		//index.ctpの表示
	}
	
	//ログイン処理
	public function login() {
		if(!empty($this->request->data)) {
	        if($this->request->is('post')) {
	            if($this->Auth->login()) {
	                return $this->redirect($this->Auth->redirectUrl());
	            } else {
	                $this->Session->setFlash(__('ユーザーIDまたはパスワードが違います/(-_-)ヽ ｺﾏｯﾀｰ'), 'default', array(), 'auth');
	            }
	        }
        }
    }

	//ユーザーの編集
    public function edit($id = 'root') {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
	
	//ログアウト処理
	public function logout($id = null)
    {
        $this->redirect($this->Auth->logout());
    }
	
	//ユーザの新規登録
	public function add() {
		//メールを送信 -> add_form.ctpを表示 -> 登録実行
		if(!empty($this->request->data)) {
	        if($this->request->is('post')) {
	            $this->User->create();
	            if ($this->User->save($this->request->data)) {
	                $this->Session->setFlash(__('登録完了 (｡･_･｡)ﾉ'));
	                $this->redirect(array('action' => 'done'));
	            } else {
	            	//$this->render('error');
	                $this->Session->setFlash(__('登録に失敗しました（￣□￣；）！！'), 'default', array(), 'register');
	            }
	        }
		}
    }
	
	public function done() {
		//新規ユーザ登録が完了した時に表示する done.ctp の表示
	}
}
