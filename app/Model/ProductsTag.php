<?php
App::uses('AppModel', 'Model');
App::uses('Tag', 'Model');

class ProductsTag extends AppModel {
	
	public $belongsTo = array(
        'Product' => array(
            'className'  => 'Product',
            'foreignKey'   => 'product_id'
		),
        'Tag' => array(
            'className'  => 'Tag',
            'foreignKey' => 'tag_id'
        )
    );
	
	public function __construct() {
		parent::__construct();
		$Tag = ClassRegistry::init('Tag');
	}
	
	public function getProductIdFromCsvTags($csvTags = '') {
		$Tag = ClassRegistry::init('Tag');
		$arrayTagIds = $Tag->getTagId($csvTags);
		$arrayProductsTags = $this->findAllByTagId($arrayTagIds);
		$productIds = array();
		foreach ($arrayProductsTags as $productsTag) {
			array_push($productIds, $productsTag['ProductsTag']['product_id']);
		}
		
		return $productIds;
	}
	
	public function addProductTags($tag_name, $product_id){
		$Tag = ClassRegistry::init('Tag');
    	if(isset($tag_name)){
			//送らてきたタグのカンマで区切られた文字列を分解す
			$tags = explode(",", $tag_name);
			foreach ($tags as $tag) {
				$tag = trim($tag);
				$result = $Tag->findByName($tag);
				if($result) {
					// 新規レコード生成
		            $this->create();
					$this->set(array(
						'tag_id'=>$result['Tag']['id'], 
						'product_id'=>$product_id));
		            $this->save();
				}
			}
    	}
		return true;
    }
	
		
	public function getRelatedProducts($blog = array()){
		$Tag = ClassRegistry::init('Tag');
		$arrayProducts = array();
		foreach($blog['Tag'] as $tag){
			// high
			$highTags = $Tag->find('all',array(
				'conditions' => array('name like' => '%'. $tag['name'] .'%'),
			));
			foreach($highTags as $highTag){
				$highResult['high'] = $this->findAllByTagId($highTag['Tag']['id']);
				if(!empty($highResult['high'])){
					$highResult['Priority'][]= 1;
					array_push($arrayProducts, $highResult);
				}
			}
		}
		
		return $arrayProducts;
	}
}
?>
