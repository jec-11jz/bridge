<?php
App::uses('AppModel', 'Model');
App::uses('Tag', 'Model');

class AttributesTag extends AppModel {
	
	public $belongsTo = array('Product', 'Tag', 'Attribute');

	// TODO: 多分修正必要
	public function addAttributeTags($tag_names = null, $attribute_id = null, $product_id = null){
		$Tag = ClassRegistry::init('Tag');
		$message = null;
    	if(!empty($tag_names)){
			//送らてきたタグのカンマで区切られた文字列を分解す
			$tags = $Tag->parseTagCSV($tag_names);
			foreach ($tags as $tag) {
				$result = $Tag->findByName($tag);
				if(!empty($result)) {
					// 新規レコード生成
		            $this->create();
					$this->set(array(
						'tag_id'=>$result['Tag']['id'], 
						'attribute_id'=>$attribute_id,
						'product_id'=>$product_id
					));
		            $this->save();
					$message = 'success add attributes_tags';
				}
			}
    	}
		$message = 'fail add attributes_tags';
		return $message;
    }
	
	public function getProductIdFromCsvTags($csvTags = '') {
		$Tag = ClassRegistry::init('Tag');
		$arrayTagIds = $Tag->getTagId($csvTags);
		$arrayProductsTags = $this->findAllByTagId($arrayTagIds);
		$productIds = array();
		foreach ($arrayProductsTags as $productsTag) {
			array_push($productIds, $productsTag['AttributesTag']['product_id']);
		}
		
		return $productIds;
	}
}
?>
