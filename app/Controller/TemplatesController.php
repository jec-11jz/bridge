<?php
App::uses('AppController', 'Controller');

class TemplatesController extends AppController {
	
	public $uses = array('Template', 'Attribute', 'User', 'AttributeTag', 'TemplateAttribute');
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        //parent::beforeFilter();
		//permitted access before login
        //$this->Auth->allow();
    }
	
	public function index(){
		$templates = $this->Template->findAllWithAttributeByUserId($this->Auth->user('id'));
		$this->set('templates', $templates);
		
		// $this->autoRender = false;
		// var_dump($templates);
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
					if(is_array($this->request->data['Attribute']['name'])){
						foreach($this->request->data['Attribute']['name'] as $names){
							if(!empty($names)){
								$attr_data = $this->Attribute->findByName($names);
								if(empty($attr_data)){
									$this->Attribute->create();
									$this->Attribute->set(array(
										'name'=>$names,
									));
									if($this->Attribute->save()){
										//アトリビュート保存成功
									} else {
										//アトリビュート保存失敗
										$this->Session->setFlash(__('アトリビュートを保存できません'),'default', array(), 'template');
									}
								}
								
								$attr_data = $this->Attribute->findByName($names);
								//template_attributeテーブル保存
								$this->TemplateAttribute->create();
								$this->TemplateAttribute->set(array(
									'template_id'=>$result['Template']['id'],
									'attribute_id'=>$attr_data['Attribute']['id']
								));
								$this->TemplateAttribute->save();
							}
						}
						// リダイレクト
				        $this->redirect(array('controller' => 'templates', 'action' => 'index'));
					}
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
		$selected_attributes = $this->TemplateAttribute->findAllByTemplateId($template_id);
		$attributes = $this->Attribute->getSelectedAttributes($selected_attributes);
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
			$_SESSION['Result'] = $result;
			if($result){
				//一度Attributeテーブルを削除してから登録する
				$this->TemplateAttribute->deleteAll(array('TemplateAttribute.template_id'=>$template_id));
				if(is_array($this->request->data['Attribute']['name'])){
					foreach($this->request->data['Attribute']['name'] as $name){
						if(!empty($name)){
							$attr_data = $this->Attribute->findByName($name);
							if(empty($attr_data)){
								$this->Attribute->create();
								$this->Attribute->set(array(
									'name'=>$name,
								));
								$this->Attribute->save();
							}
							
							$attr_data = $this->Attribute->findByName($name);
							//template_attributeテーブル保存
							$this->TemplateAttribute->create();
							$this->TemplateAttribute->set(array(
								'template_id'=>$template_id,
								'attribute_id'=>$attr_data['Attribute']['id']
							));
							$this->TemplateAttribute->save();
						}
					}
					//メッセージ
					$this->Session->setFlash('編集完了');
					//リダイレクト
					$this->redirect(array('controller'=>'templates', 'action'=>'index'));
				}
			}

		} else {
			$this->Session->setFlash('保存できませんでした');
		}
	}

	public function delete($template_id){
		$this->autoRender = false;
		if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            throw new MethodNotAllowedException();
        }
        if($this->Template->delete($template_id)) {
            // 削除成功した場合はメッセージを出し、indexへリダイレクト
            $this->Session->setFlash('作品'. $template_id . 'を削除しました');
            $this->redirect(array('action' => 'index'));
        }
	}
}
?>