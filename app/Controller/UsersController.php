<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends Controller {
	//モデルの指定
	public $uses = array('User');
	//ユーザー認証を使用する
	public $components = array('Auth');
	//認証が無くてもアクセスできるページ
	public function beforeFilter() {
 		$this->Auth->allow('index');
		$this->Auth->allow('add'); //ひとまずaddも追加しておく
		$this->Auth->allow('confirm'); 
		$this->Auth->allow('done');
		$this->Auth->allow('logout');
	}
	public function index() {
		
	}
	
	public function add() {
		print_r($this->data);
		//Confirmの値がtrue(addからの移動なら)
		if(!empty($this->request->data['User']['confirm'])) {
			if($this->User->saveAll($this->request->data, array('validate' => 'only'))) {
				//確認画面を呼び出す
				$this->render('confirm');
			}
		} else if(!empty($this->request->data['User']['cancel'])) {
			//キャンセルの場合
		} else if (!empty($this->request->data['User']['send'])) {
			//Tokenとセッションが同じ場合
 			if($this->Session->read('Token')==$this->request->data['User']['Token']) {
				$this->Session->setFlash('Some error...');
 				$this->redirect(array('action' => 'add'));
			}
			//セッションを破棄
			$this->Session->delete('Token');
			//データがある場合
			if ($this->data) {
 				$this->User->create();
				if($this->User->save($this->data)) {
					$this->Session->setFlash('Succedd');
					$this->redirect(array('action' => 'done'));
				} else {
					//保存に失敗した場合
					$this->Session->setFlash('Some error Error');
					$this->redirect(array('action' => 'add'));
				}
			} else {
				//Tokenとセッションが違う場合
				$this->Session->setFlash('Session Error');
				$this->redirect(array('action' => 'add'));
			}
		}	
		/*$this->User->set($this->request->data);
		 if($this->User->validates()){
			if ($this->request->is('post')) {
		      $this->User->save($this->request->data);
		    }
		} else {
			
		}*/
	}
	
	public function done() {
		
	}
	
}
?>
