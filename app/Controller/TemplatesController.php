<?php
App::uses('AppController', 'Controller');

class TemplatesController extends AppController {
	public $components = array('RequestHandler');
	public $uses = array('Template', 'Attribute', 'User', 'AttributeTag', 'TemplateAttribute');
	
	public function beforeFilter()
    {
    	
    }
	
	public function index(){
		$templates = null;
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		$user_info = $this->User->findById($this->Auth->user('id'));
		$this->set('user_info', $user_info);
		$this->set('templates', $templates);
	}

	public function add() {
		// if request is GET, display only screen
		if ($this->request->is('get')) {
			return;
		}
		
		// if request is POST
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
		// END (if request is POST)
	}

	public function edit($template_id = null){
		
		// if request is GET, redirect to /templates/index
		if ($this->request->is('get')) {
			$template = $this->Template->findById($template_id);
			//check whether template exist
		    $template = $this->Template->findByIdAndUserId($template_id, $this->Auth->user('id'));
			if(!$template){
				throw new NotFoundException(__('template is not found'));
			}
			$this->set('template', $template);
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
		$templateData['Template']['id'] = $template_id;
		$templateData['Attribute'] = $attributes;

		$this->Template->create();
		$result = $this->Template->saveAll($templateData);

		if ($result) {
			$this->Session->setFlash('保存に成功しました');
			$this->redirect(array('controller' => 'templates', 'action' => 'index'));
		}

		if ($this->Template->validationErrors) {
			$this->Session->setFlash('バリデーションエラーです');
		} else {
			$this->Session->setFlash('保存できませんでした');
		}
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
	
	public function api_get() {
		
		if(!isset($this->request->query['id'])){
			$this->apiError('Template is not selected');
			return;
		}

		// set selected template
		$selected_template = $this->Template->findById($this->request->query['id']);
		if (empty($selected_template)) {
			$this->apiError('Nothing this template');
			return;
		}
		$this->apiSuccess($selected_template);		
	}
}
