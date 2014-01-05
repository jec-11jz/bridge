<?php
App::uses('AppModel', 'Model');
App::uses('AttributeTag', 'Model');
App::uses('Tag', 'Model');
App::uses('TemplateAttribute', 'Model');

class Attribute extends AppModel {
	
	public $hasMany = array(
        'TemplateAttribute' => array(
            'className'     => 'TemplateAttribute',
            'foreignKey'    => 'Attribute_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            //'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        )
	);
    
    public function findAllByProductIdAndTemplateIdWithTags($product_id, $template_id) {
    	$Tag = ClassRegistry::init('TemplateAttribute');
    	$attributes = $TemplateAttribute->findAllByTemplateId($template_id);
		$Tag = ClassRegistry::init('Tag');
		foreach ($attributes as &$attribute) {
			$tags = $this->getTagsByProductIdAndAttributeId($product_id, $attribute['Attribute']['id']);
			$attribute['Tag'] = $tags;
			$attribute['tagNamesCSV'] = $Tag->tagNamesToCSV($tags); 
		}
		unset($attribute);
		return $attributes;
    }
	
	private function getTagsByProductIdAndAttributeId($product_id, $attribute_id) {
		$AttributeTag = ClassRegistry::init('AttributeTag');
		$attributeTags = $AttributeTag->findAllByProductIdAndAttributeId($product_id, $attribute_id);
		$tags = array();
		foreach ($attributeTags as $attributeTag) {
			array_push($tags, array('Tag' => $attributeTag['Tag']));
		}
		return $tags;
	}
	
	//template_attributeの配列からAttribute.nameの配列を返す
	public function getSelectedAttributes($selected_attributes) {
		if(!empty($selected_attributes)){
			foreach($selected_attributes as $selected_attribute){
				$attributes[] = $this->findById($selected_attribute['TemplateAttribute']['attribute_id']);
			}
			return $attributes;
		} else {
			return false;
		}
		
	}
	
	public function findAllByTemplateId($template_id) {
		$TemplateAttribute = ClassRegistry::init('TemplateAttribute');
		$templateAttributes = $TemplateAttribute->findAllByTemplateId($template_id);
		if (!is_array($templateAttributes) || empty($templateAttributes)) {
			return false;
		}

		$attributes = array();
		foreach ($templateAttributes as $templateAttribute) {
			array_push($attributes, $templateAttribute['Attribute']);
		}
		return $attributes;
	}
}