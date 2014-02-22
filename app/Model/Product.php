<?php
App::uses('AppModel', 'Model');
App::uses('Attribute', 'Model');
App::uses('Tag', 'Model');

class Product extends AppModel {
	
	public $hasMany = array(
		'ProductsTag'=> array(
            'className'     => 'ProductsTag',
            'foreignKey'    => 'product_id',
            'order'         => 'ProductsTag.created DESC',
            'dependent'     => true
        ), 
        'AttributesTag'=> array(
            'className'     => 'AttributesTag',
            'foreignKey'    => 'product_id',
            'order'         => 'AttributesTag.created DESC',
            'dependent'     => true
        ),
         'ProductsFavorite'=> array(
            'className'     => 'ProductsFavorite',
            'foreignKey'    => 'product_id',
            'order'         => 'ProductsFavorite.created DESC',
            'dependent'     => true
        )
	);

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
			'notEmpty' => array(
				'rule' => 'notEmpty',
        		'message' => 'product_name is empty!'
			)
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

	public function getFavList($productFavorites = array()) {
		$arrayProducts = array();
		foreach($productFavorites as $fav){
			$result = $this->findById($fav['product_id']);
			array_push($arrayProducts, $result);
		}
		
		return $arrayProducts;
	}
}
