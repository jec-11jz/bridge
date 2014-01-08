<?php
App::uses('AppModel', 'Model');

class Attribute extends AppModel {

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

	
}
