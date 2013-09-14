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
	public $components = Array(
            'Session',
            'Auth' => Array(
            	//ログイン後のリダイレクト先
                'loginRedirect' => Array('controller'  => 'users', 'action' => 'done'),
                //ログアウト後のリダイレクト先
                'logoutRedirect' => Array('controller' => 'users', 'action' => 'login'),
                //ログインしていない場合のリダイレクト先
                'loginAction' => Array('controller' => 'users', 'action' => 'login'),
                //ログインにデフォルトの username ではなく email を使うためここで書き換えています
                'authenticate' => Array('Form' => Array('fields' => Array('username' => 'email')))
            )
    );
	
	//ログイン認証前にアクセスできるアクション
	public function beforeFilter()
    {
        parent::beforeFilter();
		//ログイン認証前にアクセスできるアクション
        $this->Auth->allow('add', 'login', 'index', 'done');
    }

	public function index() {
		//index.ctpの表示
	}
	
	//ログイン処理
	public function login() {
        if($this->request->is('post')) {
            if($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect('done'));
            } else {
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
            }
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
        if($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'done'));
            } else {
            	//$this->render('error');
                $this->Session->setFlash(__('登録に失敗しました'), 'default', array(), 'register');
            }
        }
    }
	
	public function done() {
		//新規ユーザ登録が完了した時に表示する done.ctp の表示
	}
}
