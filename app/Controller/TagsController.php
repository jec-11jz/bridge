<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {
	public $layout = 'menu';
	
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index(){
		// Modelからタグ一覧を取得 ⇒ Viewへ送る
        $tags = $this->Tag->findAllByUserId($this->Auth->user('id'));
		if (!is_array($tags)) {
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
		$this->set('tags', $tags);
	}
	
	public function add(){
		// HTTP POSTリクエストか確認
        if ($this->request->is('post')) {
        	if(!empty($this->request->data['Tag']['name'])){
	        	$this->request->data['Tag']['user_id'] = $this->Auth->user('id'); 
	            // 新規レコード生成
	            $this->Tag->create();
	            // フォームから受信したPOSTデータ
	            $result = $this->Tag->save($this->request->data);
                //メッセージを出力
                print "complete";
                $this->Session->setFlash('記事を保存しました');
        	}
            // index.phpへリダイレクトBlog
            print "error1";
            $this->redirect(array('controller' => 'tags', 'action' => 'index'));
        } else {
        	print "error2";
            $this->Session->setFlash('タグを保存できません');
        }
	}
}
