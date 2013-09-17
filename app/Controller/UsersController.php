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
                'loginAction' => array('controller' => 'users', 'action' => 'login'),
                //ログインにデフォルトの username ではなく email を使うためここで書き換えています
                'authenticate' => array('Form' => array('fields' => array('username' => 'id'))),
                
            )
    );
	
	
	public function beforeFilter()
    {
        parent::beforeFilter();
		//ログイン認証前にアクセスできるアクション
        $this->Auth->allow('add', 'login', 'index', 'edit');
		
		// 現在ログイン中のユーザ情報（AppControllerで記述すればサイト全体に反映できる）
		//isAuthorized()はログイン後の細かい設定　-> 参考URL　http://24nwakahana.wordpress.com/2013/02/10/
	    debug(
	        __('Anyone was Logged', true) .' = '. $this->Auth->isAuthorized(). ', ' .
	        __('UserID', true) .' = '. $this->Auth->user('id'). ', '.
	        __('Nickname', true) .' = '. $this->Auth->user('nickname')
	    );
	    

    }

	public function index() {
		//index.ctpの表示
		
		// セッションから自分の情報を取得
	    $loginInformation = $this->Session->read('auth');
	    // ビューに渡す
	    $this->set('loginInformation', $loginInformation);
	}
	
	//ログイン処理
	public function login() {
        if($this->request->is('post')) {
            if($this->Auth->login()) {
            	$this->Session->setFlash(__('ログイン成功ヽ(ﾟ｀∀´ﾟ)ﾉｳﾋｮ'));
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('ユーザーIDまたはパスワードが違います┐(´･c_･｀ ;)┌　ﾀﾞﾒﾀﾞｺﾘｬ・・・'), 'default', array(), 'auth');
            }
        }
        
    }

	//ユーザーの編集
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('そんなユーザーいません(ﾉ｀Д´)ﾉ ｷｨｨｨ'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('更新完了です。 (｡･_･｡)ﾉ'));
				
				//Authを再設定するためにログアウト->ログイン
				$cond = $this->Auth->user('id');
				$user = $this->User->findByid($cond);
				$this->Auth->logout();//ログアウトして
				$this->Auth->login($id);//再びログイン
				
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
		//メールを送信 -> addを実行-> 登録実行
        if($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('登録完了です。 (｡･_･｡)ﾉ'));
                $this->redirect(array('action' => 'index'));
            } else {
            	//$this->render('error');
                $this->Session->setFlash(__('登録に失敗しました（￣□￣；）！！'), 'default', array(), 'register');
            }
        }
    }
	
	public function done() {
		//ログインが完了した時に表示する(beforefilterで許可していないアクション)
	}
}
