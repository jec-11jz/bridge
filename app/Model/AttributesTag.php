<?php
App::uses('AppModel', 'Model');
App::uses('Tag', 'Model');

class AttributesTag extends AppModel {
	
	public $belongsTo = array('Product', 'Tag', 'Attribute');

	// TODO: 多分修正必要
	public function addAttributeTags($tag_name, $attribute_id, $product_id){
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
						'attribute_id'=>$attribute_id,
						'product_id'=>$product_id));
		            $this->save();
				}
			}
    	}
		return true;
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
