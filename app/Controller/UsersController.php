<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	public $layout = 'menu';
	//モデルの指定
	public $uses = array('User', 'EmailAuth');
	public $components = array('RequestHandler');

	//AppControllerをオーバーライド
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('add', 'api_add', 'login', 'api_login', 'index', 'test');
		$this->set('loginInformation', $this->Auth->User());
	    
    }

	public function index() {
		$this->layout = 'default';
		$seved_data = $this->Auth->user();
		//show registered user
		$this->set('userList', $this->User->find('all'));
	}
	
	//ログイン処理
	public function login() {
		//ログイン認証されたユーザかどうか調べる
		if ($this->Auth->user()) {
			$this->Session->setFlash(__('ログアウトしてください'),'default', array(), 'auth');
			return;
		}

		if(!$this->request->is('post')) {
			return;
		}

		if($this->Auth->login()) {
			$this->Session->setFlash(__('ログイン成功'),'default', array(), 'auth');
		} else {
			$this->Session->setFlash(__('メールアドレスまたはパスワードが違います'), 'default', array(), 'auth');
		}
		return $this->redirect($this->Auth->redirectUrl());
	}

	public function api_login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->apiSuccess();
				return;
			}
		}

		$this->apiError('メールアドレスまたはパスワードが違います');	
	}


	//ユーザの新規登録
	public function add() {		
		if ($this->Auth->user()) {
			$this->Session->setFlash(__('ログアウトしてください'),'default', array(), 'auth');
			return;
		}
		if(!$this->request->is('post')) {
			return;
		}

		$result = $this->__add();
		if ($result) {
			$this->Session->setFlash(__('登録完了です'),'default', array(), 'auth');
		} else {
			$this->Session->setFlash(__('登録に失敗しました'), 'default', array(), 'auth');
		}
		return $this->redirect($this->Auth->redirectUrl());
	}

	public function api_add() {
		if ($this->request->is('post')) {
			$result = $this->__add();
			if ($result) {
				$this->apiSuccess();
				return;
			}
		}

		if ($this->User->validationErrors) {
			$this->apiValidationError('User', $this->User->validationErrors);
		} else {
			$this->apiError('add error');
		}
	}

	private function __add() {
		$this->request->data['User']['name'] = strtolower($this->request->data['User']['name']);
		$this->User->create();
		$result = $this->User->save($this->request->data);
		if ($result) {
			$this->Auth->login();
			$this->__send_add_email($result['User']['id']);
		}
		return $result;
	}


	//ユーザーの編集
    public function edit($id = null) {
        $this->User->id = $this->Auth->user('id');
		$data = $this->User->findById($this->Auth->user('id'));
		
		//ログイン中のユーザのIDからのユーザ情報を検索
        if ($data) {
	        if ($this->request->is('post') || $this->request->is('put')) {
	        	$saved_data = $this->User->save($this->data, TRUE, array('nickname', 'email'));
	            if ($saved_data) {
	            	
					//セッション情報の更新
					$this->Session->write('Auth.User.nickname', $saved_data['User']['nickname']);
					$this->Session->write('Auth.User.email', $saved_data['User']['email']);
					
	                $this->Session->setFlash(__('更新完了です'),'default', array(), 'auth');
					$this->redirect(array('action' => 'index'));
					
	            } else {
	                $this->Session->setFlash(__('The user could not be saved. Please, try again.'),'default', array(), 'auth');
	            }
	        } else {
	            $this->request->data = $this->User->read(null, $id);
	            unset($this->request->data['User']['password']);
	        }
        } else {
        	$this->render('login');
        }
		
		$this->set('error', $this->User->validationErrors);
		

    }
	//ログアウト処理
	public function logout($id = null)
    {
        $this->redirect($this->Auth->logout());
    }

    private function __send_add_email($user_id) {
        $this->EmailAuth->create();
        $emailAuth = $this->EmailAuth->findByUserId($user_id);
        if (!$emailAuth) {
            // エラーログ出すとか
            exit;
        }
        $body = array(
            'auth_url' => Router::url(
                array(
                    'controller'=>'users',
                    'action'=>'email_verify',
                    $user_id,
                    $emailAuth['EmailAuth']['token']
                ),
                true
            )
        );

		$email = new CakeEmail('register');
		$email->to($emailAuth['User']['email']);
		$email->viewVars($body);
		$email->send();
    }

    public function email_verify($user_id, $token) {
        if (!isset($user_id) || !isset($token)) {
            print 'param error';
            exit;
        }
        $this->EmailAuth->create();
        $result = $this->EmailAuth->checkValid($user_id, $token);
        if (!$result) {
            print 'token error';
            exit;
        }

        $this->redirect('/');
    }
}
