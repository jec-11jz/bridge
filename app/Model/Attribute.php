<?php
App::uses('AppModel', 'Model');
App::uses('AttributeTag', 'Model');
App::uses('Tag', 'Model');

class Attribute extends AppModel {
	
	// public $belognsTo = array(
        // 'Template' => array(
            // 'className'  => 'Template',
            // 'foreignKey'   => 'template_id'
        // )
    // );
    
    public function findAllByProductIdAndTemplateIdWithTags($product_id, $template_id) {
    	$attributes = $this->findAllByTemplateId($template_id);
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
}