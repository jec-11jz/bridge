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
			)
		)
    );
	
	public function get_default_templates($user_id = null){
		$arrayTemp = array();
		
		$arrayTemp = array(
			array(
				'Template' => array(
					'name' => '映画',
					'user_id' => $user_id
				),
			)
		);
	}
	
	
}
