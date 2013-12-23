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
	var $components = array('RequestHandler');
	
	//モデルの指定
	public $uses = array('User', 'EmailAuth');
	
	//AppControllerをオーバーライド
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('add', 'login', 'index', 'test');
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
        } else {
	        if($this->request->is('post')) {
	        	// if(strstr($this->data['User']['name'],'@')){
	        		// $this->User->email = $this->Auth->user('name');
		        	// $this->data['User']['email'] = $this->data['User']['name'];
		        	// $this->Auth->fields['id'] = 'email';
		        // }
	            if($this->Auth->login()) {
	            	$this->Session->setFlash(__('ログイン成功ヽ(ﾟ｀∀´ﾟ)ﾉｳﾋｮ'),'default', array(), 'auth');
					if($this->request->is('ajax')) {
						$this->autoRender = false;
						$body['success'] = array(
							'message' => 'Success!!'
						);
						print json_encode($body);
						return;
					}
					return $this->redirect($this->Auth->redirectUrl());
	            } else {
	            	$this->Session->setFlash(__('メールアドレスまたはパスワードが違います'), 'default', array(), 'auth');
					if($this->request->is('ajax')) {
						$this->autoRender = false;
	                	$body['errors'] = array('name_and_pass' => 'メールアドレスまたはパスワードが違います');
						print json_encode($body);
					} else {
						return $this->redirect($this->Auth->redirectUrl());
					}
					
	            }
	        }
		}
        
    }

	//ユーザの新規登録
	public function add() {		
		if ($this->Auth->user()) {
        	$this->Session->setFlash(__('ログアウトしてください'),'default', array(), 'auth');
        } else {
	        if($this->request->is('post')) {
				$this->request->data['User']['name'] = strtolower($this->request->data['User']['name']);
                $this->User->create();
                $result = $this->User->save($this->request->data);
                if ($result) {
                    $this->__send_add_email($result['User']['id']);
					$this->Auth->login();
					$this->Session->setFlash(__('登録完了です。 (｡･_･｡)ﾉ'),'default', array(), 'auth');
					
					if($this->request->is('ajax')) {
						$this->autoRender = false;
						$body['success'] = array(
							'message' => 'Success!!'
						);
						print json_encode($body);
						return;
					} else {
						return $this->redirect($this->Auth->redirectUrl());
					}
	            } else {
	                $this->Session->setFlash(__('登録に失敗しました（￣□￣；）！！'), 'default', array(), 'auth');
					if($this->request->is('ajax')) {
						$this->autoRender = false;
						if ($this->User->validationErrors) {
							$body['errors'] = $this->User->validationErrors;
						} else {
							$body['errors'] = array('sql' => 'sql error');
						}
						print json_encode($body);
						return;
					}
					
					return $this->redirect($this->Auth->redirectUrl());
	            }
	        }
		}
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
					
	                $this->Session->setFlash(__('更新完了です。 (｡･_･｡)ﾉ'),'default', array(), 'auth');
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
