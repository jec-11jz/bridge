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
	//コンポーネントの設定（普通はAppControllerに書くかも...）
	public $components = array(
            'Session',
            'Auth' => array(
            	//ログイン後のリダイレクト先
                'loginRedirect' => array('controller'  => 'users', 'action' => 'done'),
                //ログアウト後のリダイレクト先
                'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
                //ログインしていない場合のリダイレクト先
                'loginAction' => array('controller' => 'users', 'action' => 'index'),
                //ログインにデフォルトの username ではなく email を使うためここで書き換えています
                'authenticate' => array('Form' => array('fields' => array('username' => 'id')))
                
            )
    );
	
	//AppControllerをオーバーライド
	public function beforeFilter()
    {
        parent::beforeFilter();
		//ログイン認証前にアクセスできるアクション
        $this->Auth->allow('add', 'login', 'index');
	    
    }

	public function index() {
		//index.ctpの表示
		$this->set('userList', $this->User->find('all'));
	}
	
	//ログイン処理
	public function login() {
		$this->User->id = $this->Auth->user('id');
		//ログイン認証されたユーザかどうか調べる
        if ($data = $this->User->findById($this->Auth->user('id'))) {
        	//既にログインしていた場合ログイン後のリダイレクト先に飛ばす
        	$this->redirect($this->Auth->redirectUrl());
        } else {
        	
	        if($this->request->is('post')) {
	            if($this->Auth->login()) {
	            	$this->Session->setFlash(__('ログイン成功ヽ(ﾟ｀∀´ﾟ)ﾉｳﾋｮ'));
	                return $this->redirect($this->Auth->redirectUrl());
	            } else {
	                $this->Session->setFlash(__('ユーザーIDまたはパスワードが違います┐(´･c_･｀ ;)┌　ﾀﾞﾒﾀﾞｺﾘｬ・・・'), 'default', array(), 'auth');
	            }
	        }
		}
        
    }

	//ユーザーの編集
    public function edit($id = null) {
        $this->User->id = $this->Auth->user('id');
		
		//ログイン中のユーザのIDからのユーザ情報を検索
        if ($data = $this->User->findById($this->Auth->user('id'))) {
	        if ($this->request->is('post') || $this->request->is('put')) {
	        	//
	        	$this->set('userID', $data);
	            if ($this->User->save($this->data, TRUE, array('nickname', 'email'))) {
	            	
					//セッション情報の更新
	            	$this->Auth->logout();
	            	$this->Auth->login($this->Auth->user('id'));
					
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
	
	//ログアウト処理
	public function logout($id = null)
    {
        $this->redirect($this->Auth->logout());
    }
	
	//ユーザの新規登録
	public function add() {
		//メールを送信 -> addを実行-> 登録実行
        if($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('登録完了です。 (｡･_･｡)ﾉ'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('登録に失敗しました（￣□￣；）！！'), 'default', array(), 'register');
            }
        }
    }
	
	public function done() {
		//ログインが完了した時に表示する(beforefilterで許可していないアクション)
	}
}
