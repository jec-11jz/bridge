<?php
App::uses('AppController', 'Controller');

class TemplatesController extends AppController {
	
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
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		if(!is_array($templates)){
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
		
		$this->set('templates', $templates);
	}
	
    public function add(){
    	$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		if(!is_array($templates)){
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
    	$this->set('templates', $templates);
		if($this->request->is('post')){
			if(!empty($this->request->data['Template']['name'])){
				// 登録者のuser_idを渡す
				$this->request->data['Template']['user_id'] = $this->Auth->user('id');
				// 新規レコード生成
				$this->Template->create();
				//テンプレートを保存
				$result = $this->Template->save($this->request->data);
				if($result){
					foreach($this->request->data['Attribute']['name'] as $names){
						$this->Attribute->create();
						if(!empty($names)){
							$this->Attribute->set(array(
								'name'=>$names,
								'template_id'=>$result['Template']['id']
							));
						
							if($this->Attribute->save()){
								//アトリビュート保存成功
							} else {
								//アトリビュート保存失敗
								$this->Session->setFlash(__('アトリビュートを保存できません'),'default', array(), 'template');
							}
						}
					}
					// リダイレクト
			        $this->redirect(array('controller' => 'templates', 'action' => 'index'));
				}
			}
			$this->Session->setFlash(__('テンプレート名を入力してください'),'default', array(), 'template');
		}
	}

	public function edit($template_id = null){
		if (!$template_id) {
        	throw new NotFoundException(__('template_id is not found'));
    	}
		//テンプレートが存在するかどうかを確かめる
	    $template = $this->Template->findById($template_id);
		if(!$template){
			throw new NotFoundException(__('template is not found'));
		}
		//Viewにテンプレートを渡す
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		if(!is_array($templates)){
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
		//Viewにアトリビュートを渡す
		$attributes = $this->Attribute->findAllByTemplateId($template_id);
		if(!is_array($attributes)){
			// error
			$this->autoRender = false;
			print 'not found';
			return;
		}
		$this->set('attributes', $attributes);
    	$this->set('templates', $templates);
		$this->set('template_id', $template_id);
		if ($this->request->is(array('post', 'put'))) {
			$this->Template->id = $template_id;
			$result = $this->Template->save($this->request->data);
			if($result){
				//一度Attributeテーブルを削除してから登録する
				$this->Attribute->deleteAll(array('Attribute.template_id'=>$template_id));
				foreach($this->request->data['Attribute']['name'] as $names){
					$this->Attribute->create();
					if(!empty($names)){
						$this->Attribute->set(array(
							'name'=>$names,
							'template_id'=>$template_id
						));
					
						if($this->Attribute->save()){
							//アトリビュート保存成功
						} else {
							//アトリビュート保存失敗
							$this->Session->setFlash('アトリビュートを保存できません');
						}
					}
				}
				//メッセージ
				$this->Session->setFlash('編集完了');
				//リダイレクト
				$this->redirect(array('controller'=>'templates', 'action'=>'index'));
			}
		} else {
			$this->Session->setFlash('保存できませんでした');
		}
	}
}
?>