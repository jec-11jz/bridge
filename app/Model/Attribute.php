<?php
App::uses('AppModel', 'Model');

class Attribute extends AppModel {

	public $validate = array(
		'name' => array(
			'rule' => 'isUnique',
			'message' => 'duplicated'
		)
	);

	public function deleteDuplication($attributes) {
		$_results = array();
		foreach ($attributes as $attribute) {
			$_results[$attribute['id']] = $attribute;
		}
		$results = array();
		foreach ($_results as $_result) {
			array_push($results, $_result);
		}
		return $results;
	}

	public function saveFromNameArray($attributeNames = array()) {
		foreach ($attributeNames as $attributeName) {
			$this->create();
			$this->set('name', $attributeName);
			$this->save();
		}
		return true;
	}

}
