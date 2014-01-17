<?php
App::uses('AppModel', 'Model');
App::uses('Attribute', 'Model');
App::uses('Tag', 'Model');

class Product extends AppModel {
	
	public $hasMany = array('ProductsTag', 'AttributesTag');

	public $hasAndBelongsToMany = array(
		'Attribute' => array(
			'className' => 'Attribute',
			'joinTable' => 'attributes_tags',
			'foreginKey' => 'product_id',
			'associationForeginKey' => 'attribute_id'
		)
	);
	
	public $validate = array(
        'name' => array(
        	'requeired',
            'rule' => 'notEmpty'
        )
	);


	public function __construct() {
		parent::__construct();
		$this->Attribute = ClassRegistry::init('Attribute');
		$this->Tag       = ClassRegistry::init('Tag');
	}

	// MEMO
	// findBy, findAllBy のみテスト
	// その他に関しては未保証
	public function afterFind($results, $primary = false) {
		if (!is_array($results) or empty($results)) {
			return $results;
		}

		foreach($results as &$result) {
			if (!array_key_exists('Attribute', $result)) {
				continue;
			}
			$result['Attribute'] = $this->__associatedAttributeAndTag($result['Attribute'], $result['Product']['id']);
		}
		return $results;
	}

	private function __associatedAttributeAndTag($attributes = array(), $product_id) {
		$attributes = $this->Attribute->deleteDuplication($attributes);
		foreach($attributes as &$attribute) {
			$attribute['Tag'] = $this->Tag->findAllByAttributeIdAndProductId($attribute['id'], $product_id);
		}
		unset($attribute);
		return $attributes;
	}
}
