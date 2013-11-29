<?php
App::uses('AppModel', 'Model');
	class Tag extends AppModel {
		 public $belognsTo = array(
	        'User' => array(
	            'className'  => 'User',
	            'foreignKey'   => 'user_id',
	            'department' => 'true'
	        )
	    );
		
		
	}
?>