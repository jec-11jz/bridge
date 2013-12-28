<?php
App::uses('AppModel', 'Model');
App::uses('Tag', 'Model');

class AttributeTag extends AppModel {
	
	public $belognsTo = array(
        'Product' => array(
            'className'  => 'Product',
            'foreignKey'   => 'product_id'
		),
        'Tag' => array(
            'className'  => 'Tag',
            'foreignKey' => 'tag_id'
        ),
        'Attribute' => array(
            'className'  => 'Attribute',
            'foreignKey'   => 'attribute_id'
		)
    );
	public $belongsTo = array('Product','Tag', 'Attribute');
	
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
}
?>