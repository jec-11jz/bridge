<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
/**
 * EmailAuth Model
 *
 * @property User $User
 */
class EmailAuth extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'email_auth';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function createRecord($user_id) {
		$this->create();
		$this->set('user_id', $user_id);
		$this->set('token', String::uuid());
		$this->set('status_type', 'created');
		return $this->save();
	}
	
	public function checkValid($user_id, $token) {
        $this->create();
		$emailAuth = $this->findByUserIdAndToken($user_id, $token);
        if (!is_array($emailAuth)) {
			return false;
		}
		
        #$this->getDataSource()->begin();
        $chengeStatusResult = $this->__chengeStatusTypeToChecked($emailAuth['EmailAuth']['id']);
		if (!is_array($chengeStatusResult)) {
			return false;
        }
		return true;
	}
	
	private function __chengeStatusTypeToChecked($id) {
        $this->create();
        $this->set('id', $id);
        $this->set('status_type', 'checked');
        $result = $this->save();
        return $result;
	}
	
}
