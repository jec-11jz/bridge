<?php
App::uses('AppModel', 'Model');

class Template extends AppModel {

	public $belongsTo = array('User');

	public $hasAndBelongsToMany = array('Attribute');
	
	public $validate = array(
        'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'allowEmpty'=> false,
				'message' => '必須項目です'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'duplicated'
			)
		)
    );
	
	
}
