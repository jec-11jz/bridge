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
}
?>
