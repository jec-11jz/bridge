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
	
	//AppControllerをオーバーライド
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//ログイン認証前にアクセスできるアクション
        $this->Auth->allow('add', 'login', 'index');
		$this->set('loginInformation', $this->Auth->User());
	    
    }

	public function index() {
		$seved_data = $this->Auth->user();
		//index.ctpの表示
		$this->set('userList', $this->User->find('all'));
	}
	
	//ログイン処理
	public function login() {
		
		//ログイン認証されたユーザかどうか調べる
        if ($data = $this->User->findById($this->Auth->user('id'))) {
        	//既にログインしていた場合ログイン後のリダイレクト先に飛ばす
        	$this->redirect($this->Auth->redirectUrl());
        } else {
        	
	        if($this->request->is('post')) {
	        	if(strstr($this->data['User']['name'],'@')){
	        		$this->User->email = $this->Auth->user('name');
		        	$this->data['User']['email'] = $this->data['User']['name'];
		        	$this->Auth->fields['id'] = 'email';
		        }
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
