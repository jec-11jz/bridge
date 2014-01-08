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
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		$this->set('templates', $templates);
	}

	public function add() {
		if (!$this->request->is('post')) {
			return;
		}

		$this->Attribute->saveFromNameArray($this->request->data['Attribute']['name']);
		$attributes = $this->Attribute->find('list', array(
			'conditions' => array(
				'Attribute.name' => $this->request->data['Attribute']['name'],
			),
			'fields' => array('Attribute.id')
		));


		$templateData = array('Template' => $this->request->data['Template']);
		$templateData['Template']['user_id'] = $this->Auth->user('id');
		$templateData['Attribute'] = $attributes;

		$this->Template->create();
		$result = $this->Template->saveAll($templateData);

		if ($result) {
			$this->redirect(array('controller' => 'templates', 'action' => 'index'));
			return;
		}

		if ($this->Template->validationErrors) {
			$this->Session->setFlash('バリデーションエラーです');
		} else {
			$this->Session->setFlash('保存できませんでした');
		}


	}

	public function edit($id = null){
		//テンプレートが存在するかどうかを確かめる
	    $template = $this->Template->findByIdAndUserId($id, $this->Auth->user('id'));
		if(!$template){
			throw new NotFoundException(__('template is not found'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Attribute->saveFromNameArray($this->request->data['Attribute']['name']);
			$attributes = $this->Attribute->find('list', array(
				'conditions' => array(
					'Attribute.name' => $this->request->data['Attribute']['name'],
				),
				'fields' => array('Attribute.id')
			));

			$templateData = array('Template' => $this->request->data['Template']);
			$templateData['Template']['id'] = $id;
			$templateData['Attribute'] = $attributes;

			$this->Template->create();
			$result = $this->Template->saveAll($templateData);

			if ($result) {
				$this->Session->setFlash('保存に成功しました');
			}

			if ($this->Template->validationErrors) {
				$this->Session->setFlash('バリデーションエラーです');
			} else {
				$this->Session->setFlash('保存できませんでした');
			}
		}

		// 現状だとsaveに失敗すると編集していた内容が消える
		$template = $this->Template->findById($id);
		$this->set('template', $template);
	}

	public function api_delete() {
		if (!$this->request->is('delete')) {
			$this->apiError('method error');
			return;
		}
		
		$id = null;
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		}

		$template = $this->Template->findByIdAndUserId($id, $this->Auth->user('id'));
		if (!$template) {
			$this->apiError('template is not found', 404, 404);
			return;
		}

		$result = $this->Template->delete($id);
		if (!$result) {
			$this->apiError('cant delete');
			return;
		}

		$this->apiSuccess(array('message' => 'success'));
	}

	public function delete($id = null) {
		if ($this->request->is('get')) {
			$this->Session->setFlash('method error');
			$this->redirect(array('controller' => 'templates', 'action' => 'index'));
			return;
		}

		$template = $this->Template->findByIdAndUserId($id, $this->Auth->user('id'));
		if (!$template) {
			$this->Session->setFlash('id not found');
			$this->redirect(array('controller' => 'templates', 'action' => 'index'));
			return;
		}

		$result = $this->Template->delete($id);
		if (!$result) {
			$this->Session->setFlash('cant delete');
			$this->redirect(array('controller' => 'templates', 'action' => 'index'));
			return;

		}
		
		$this->Session->setFlash('削除されました');
		$this->redirect(array('controller' => 'templates', 'action' => 'index'));
	}
}
