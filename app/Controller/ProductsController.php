<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {
	
	public $uses = array('Template', 'Attribute', 'User', 'Product', 'ProductsFavorite', 'Tag', 'AttributesTag', 'ProductsTag', 'AttributesTemplate');
	public $components = array('RequestHandler');
	
	public function beforeFilter()
    {
    	// 親クラス（AppController）読み込み
        parent::beforeFilter();
		// permitted access before login
        $this->Auth->allow('view', 'api_view', 'api_add_favorites');
    }
	
	public function index(){
		//send templates to view
		$products = $this->Product->find('all');
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		$this->set('products', $products);
		$this->set('templates', $templates);
	}
	
	public function add() {
		if($this->request->is('get')){
			// send templates to view
			$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
			if(!is_array($templates)){
				// error
				print 'templates are not array';
				return;
			}
			$this->set('templates', $templates);
		}
	}

	
	public function api_add() {
		
		// check http method
		if (!$this->request->is('post')) {
			$this->apiError('http method is not "POST"');
			return;
		}
		// set user_id of auth to user_id of product
		$this->request->data['Product']['user_id'] = $this->Auth->user('id');
		
		//add product
		if(!isset($this->request->data['Product']['name'])) {
			$this->apiError('Product name field is required');
			return;
		}
		$this->Product->create();
		$result = $this->Product->save($this->request->data);
		
		if ($this->Product->validationErrors) {
			$this->apiValidationError('Product', $this->Product->validationErrors);
			return;
		}
		
		if (!$result) {
			return $this->apiError('product add error');
		}

		//add Tag and ProductTags
		$this->Tag->saveFromNamesCSV(
			$this->request->data['Product']['name']
		);
		$this->ProductsTag->addProductTags(
			$this->request->data['Product']['name'],
			$result['Product']['id']
		);
		
		foreach($this->request->data['AttributeTag'] as $tags) {
			if(!($tags['tag'] === "")){
				// add attribute
				$this->Attribute->create();
				$this->Attribute->set('name', $tags['attribute']);
				$attr_result = $this->Attribute->save();
				// add Tags
				$this->Tag->saveFromNamesCSV(
					$tags['tag']
				);
				// add AttirbuteTags
				$tag_attribute = $this->Attribute->findByName($tags['attribute']);
				$this->AttributesTag->addAttributeTags(
					$tags['tag'],
					$tag_attribute['Attribute']['id'],
					$result['Product']['id']
				);
			}
		}
		// success
        $this->apiSuccess(array('message' => 'save success'));
	}

	public function api_edit() {
		
		$product_id = $this->request->data['Product']['id'];
		if (!$this->request->is(array('post','put'))) {
			$this->apiError(array('message'=>'http method is not "POST or PUT"'));
			return;
		}
		
		// add product
		if(!isset($this->request->data['Product']['name'])) {
			$this->apiError('Product name field is required');
			return;
		}
		
		$this->Product->id = $product_id;
		$result = $this->Product->save($this->request->data);
		
		if (!$result) {
			return $this->apiError('Fail to add product');
		}
		
		//一度AttributeTagとProductTagテーブルのデータを削除する
		$this->AttributesTag->deleteAll(array('AttributesTag.product_id'=>$product_id));
		$this->ProductsTag->deleteAll(array('ProductsTag.product_id'=>$product_id));
		
		//add Tag and ProductTags
		$this->Tag->saveFromNamesCSV(
			$this->request->data['Product']['name']
		);
		$this->ProductsTag->addProductTags(
			$this->request->data['Product']['name'],
			$product_id
		);
		
		foreach($this->request->data['AttributeTag'] as $tags) {
			if(!empty($tags['tag'])){
				$attr = $this->Attribute->findByName($tags['attribute']);	
				// add attribute
				if(empty($attr)){
					$this->Attribute->create();
					$this->Attribute->set('name', $tags['attribute']);
					$this->Attribute->save();
				}
				// add Tags
				$this->Tag->saveFromNamesCSV($tags['tag']);
				// add AttirbuteTags
				$tag_attribute = $this->Attribute->findByName($tags['attribute']);
				$this->AttributesTag->addAttributeTags(
					$tags['tag'],
					$tag_attribute['Attribute']['id'],
					$product_id
				);
			}
		}
		// success
        return $this->apiSuccess('save success');		
		
	}

	public function edit($product_id = null) {

		if(!$product_id){
			throw new NotFoundException(__('product_id is not found'));
		}
		//必要な情報の取得
		$product = $this->Product->findById($product_id);
		$product_names = str_replace(',' , ', ' ,$product['Product']['name']);
		
		// send templates to view
		$product['Templates'] = $this->Template->findAllByUserId($this->Auth->user('id'));
		
		foreach($product['Attribute'] as &$product_attr) {
			$product_attr['Tag']['tagNamesCSV'] = $this->Tag->tagNamesToCSV($product_attr['Tag']);
		}
		unset($product_attr);
		$this->set('product', $product);
	}
	
	public function view($product_id = null) {
		if(!$product_id){
			throw new NotFoundException(__('product_id is not found'));
		}
		//必要な情報の取得
		$product = $this->Product->findById($product_id);
		
		$this->set('product', $product);
	}
	
	public function api_view() {
		$product_id = null;
		$products = array();
		if(!empty($this->request->query['product_id'])){
			$product_id = $this->request->query['product_id'];
		}
		$products = $this->Product->findById($product_id);
		
		if(empty($products)){
			return $this->apiError('作品が存在しません。');
		}
		unset($product_attr);
		return $this->apiSuccess($products);
	}
	
	public function api_add_favorites() {
		$product_id = null;
		$user_id = null;
		$status = null;
		$message = null;
		if(!empty($this->request->data['product_id'])){
			$product_id = $this->request->data['product_id'];
		}
		
		if(!empty($this->request->data['status'])){
			$status = $this->request->data['status'];
		}
		if(is_null($product_id)){
			return $this->apiError('作品が存在しません');
		}
		if(is_null($this->Auth)){
			return $this->apiError('ログインしてください');
		}
		$user_id = $this->Auth->user('id');
		$message = $this->ProductsFavorite->saveUsersProducts($product_id, $user_id, $status);
		$this->apiSuccess($message);
	}

	public function delete($product_id = null) {
    	$this->autoRender = false;
        // HTTP GETリクエストか確認
        if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            // throw new MethodNotAllowedException();
        }
        if($this->Product->delete($product_id)) {
            // 削除成功した場合はメッセージを出し、indexへリダイレクト
            $this->Session->setFlash('作品'. $product_id . 'を削除しました');
            $this->redirect(array('action' => 'index'));
        }
    }
}
?>
