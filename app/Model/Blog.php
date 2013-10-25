<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Blog extends AppModel {
	 public $belognsTO = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey'   => 'user_id',
            'conditions' => array('User.approved' => '1'),
            'department' => 'true'
        )
    );
	
}
?>