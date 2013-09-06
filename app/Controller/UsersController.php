<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	    // Authコンポーネント
    var $components = array( 'Auth');

    public function beforeFilter() {
        parent::beforeFilter();
        // 非ログイン時にも実行可能とする
        $this->Auth->allow( array( 'signup', 'activate'));
    }
	
	public function signup() {
	    if (!empty( $this->data)){
	        //  保存
	        if( $this->User->save( $this->data)){
	            // ユーザアクティベート(本登録)用URLの作成
	            $url = FULL_BASE_URL                     // ドメイン
	                . $this->request->webroot            // サブディレクトリ
	                . $this->name . DS . 'activate' . DS // コントローラ/アクション
	                . $this->User->id . DS               // ユーザID
	                . $this->User->password .  DS ;// ハッシュ値
	            //  メール送信
	            //  return
	            $this->Session->setFlash( '仮登録成功。メール送信しました。');
	        } else {
	            //  バリデーションエラーメッセージを渡す
	            $this->Session->setFlash( '入力エラー');
	        }
	    }
	}
	
	public function activate( $user_id = null, $in_hash = null) {
	    // UserモデルにIDをセット
	    $this->User->id = $user_id;
	    if ($this->User->exists() && $in_hash == $this->User->getActivationHash()) {
	    // 本登録に有効なURL
	        // statusフィールドを0に更新
	        $this->User->saveField( 'status', 0);
	        $this->Session->setFlash( 'Your account has been activated.');
	    }else{
	    // 本登録に無効なURL
	        $this->Session->setFlash( 'Invalid activation URL');
	    }
	}
}
