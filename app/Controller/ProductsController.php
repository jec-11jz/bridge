<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {
	
	public $uses = array('Template', 'Attribute', 'User', 'Product', 'Tag', 'AttributesTag', 'ProductsTag', 'AttributesTemplate');
	
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        //parent::beforeFilter();
		//permitted access before login
		//$this->Auth->allow();
	}

	public function index(){
		//send templates to view
		$products = $this->Product->find('all');
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		$this->set('products', $products);
		$this->set('templates', $templates);
	}
	
	public function add($template_id = null) {
				
    	// set template_id which selected by user
    	if(isset($_GET['data'])){
    		$template_id = $_GET['data'];
		} else {
			// $this->autoRender = false;
			// print 'ERROR : please select the template by /products/index';
			// return;
		}
		
  		// set user_id of auth to user_id of product
		$this->request->data['Product']['user_id'] = $this->Auth->user('id');
		// send templates to view
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		$selected_template = $this->Template->findById($template_id);
		
		if(!is_array($templates) || !is_array($selected_template)){
			// error
			$this->autoRender = false;
			print 'templates or selected_template are not array';
			return;
		}
		$this->set('templates', $templates);
		$this->set('selected_template', $selected_template);
		
		// after click button of register
		if($this->request->is(array('post','ajax'))){
			//add product
			$this->Product->create();
			$result = $this->Product->save($this->request->data());
			if($result){
				$tag_type = 1;
				//add ProductTags
				$this->Tag->addTags(
					$this->request->data['Product']['name'],
					$this->Auth->user('id'),
					$tag_type
				);
				$this->ProductTag->addProductTags(
					$this->request->data['Product']['name'],
					$result['Product']['id']
				);
				$tag_type = 0;
				foreach($this->request->data['AttributeTag'] as $tags){
					if(!($tags['tag'] === "")){
						//add Tags
						$this->Tag->addTags(
							$tags['tag'],
							$this->Auth->user('id'),
							$tag_type
						);
						// add AttirbuteTags
						$this->AttributeTag->addAttributeTags(
							$tags['tag'],
							$tags['attribute_id'],
							$result['Product']['id']
						);
						
					}
				}
				//メッセージを出力
                $this->Session->setFlash('記事を保存しました');
			}
			// リダイレクト
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		} else {
			// Get method
		}
	}

	public function edit($product_id = null){
		if(!$product_id){
			throw new NotFoundException(__('product_id is not found'));
		}
		//必要な情報の取得
		$product = $this->Product->findById($product_id);
		$product_names = str_replace(',' , ', ' ,$product['Product']['name']);
		$template_id = $product['Product']['template_id'];
		$templates = $this->Template->findAllByUserId($this->Auth->user('id'));
		$attributes = $this->Attribute->findAllByProductIdAndTemplateIdWithTags($product['Product']['id'], $product['Template']['id']);
		$this->set('product', $product);
		$this->set('templates', $templates);
		$this->set('attributes', $attributes);
		$this->set('product_names', $product_names);
		
 		if($this->request->is(array('post','put'))){
			$this->Product->id = $product_id;
			$result = $this->Product->save($this->request->data);
			if($result){
				//一度AttributeTagとProductTagテーブルのデータを削除する
				$this->AttributeTag->deleteAll(array('AttributeTag.product_id'=>$product_id));
				$this->ProductTag->deleteAll(array('ProductTag.product_id'=>$product_id));
				$tag_type = 1;
				//add ProductTags
				$this->Tag->addTags(
					$this->request->data['Product']['name'],
					$this->Auth->user('id'),
					$tag_type
				);
				$this->ProductTag->addProductTags(
					$this->request->data['Product']['name'],
					$product_id
				);
				$tag_type = 0;
				foreach($this->request->data['AttributeTag'] as $tags){
					if(!($tags['tag'] === "")){
						//add Tags
						$this->Tag->addTags(
							$tags['tag'],
							$this->Auth->user('id'),
							$tag_type
						);
						// add AttirbuteTags
						$this->AttributeTag->addAttributeTags(
							$tags['tag'],
							$tags['attribute_id'],
							$product_id
						);
					}
				}
				//メッセージを出力
                $this->Session->setFlash('記事を保存しました');
			}
			// リダイレクト
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
	}

	public function delete($product_id = null) {
    	$this->autoRender = false;
        // HTTP GETリクエストか確認
        if($this->request->is('get')) {
            // 削除ボタン以外でこのページに来た場合はエラー
            throw new MethodNotAllowedException();
        }
        if($this->Product->delete($product_id)) {
            // 削除成功した場合はメッセージを出し、indexへリダイレクト
            $this->Session->setFlash('作品'. $product_id . 'を削除しました');
            $this->redirect(array('action' => 'index'));
        }
    }
}
?>
