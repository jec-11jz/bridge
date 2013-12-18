<?php
App::uses('AppController', 'Controller');

class AttributesController extends AppController {
	
	public $uses = array('Template', 'Attribute', 'User');
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        //parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index(){
		//Attributeの一覧表示
		$templates = $this->Template->findByUserId($this->Auth->user('id'));
		$attributes = $this->Attribute->findByTemplateId($templates['Template']['id']);
		if(!is_array($attributes)){
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
		
		$this->set('templates', $templates);
		$this->set('attributes', $attributes);
	}
	
    public function add(){
		if($this->request->is('post')){
			// 登録者のuser_idを渡す
			$this->request->data['Attribute']['user_id'] = $this->Auth->user('id');
			// 新規レコード生成
			$this->Attribute->create();
			if($this->Attribute->save($this->request->data)){
				//メッセージを出力
                $this->Session->setFlash('保存しました');
				// リダイレクト
                $this->redirect(array('controller' => 'attributes', 'action' => 'add'));
			} else {
				$this->Session->setFlash('記事を保存できません');
			}
			
		}
	}
}
?>