<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	
		//ユーザーIDのvalidation
		'id' => array(
			//上書きされる
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				//'message' => 'そのユーザーIDは既に使われています'
			),
			//働かない
			'alphaumeric' => array(
                'rule' => 'alphaNumeric',
                //'message' => '半角英数字のみ使用できます'
            ),
            'maxLength' => array(
				'rule' => array('maxLength', '15'),
				//'message' => '15文字以内で入力してください'
			)
		),
		
		//ユーザー名のvalidation
		'nickname' => array(
			'maxLength' => array(
				'rule' => array('maxLength', '30'),
				'allowEmpty'=>true,
				//'message'=>'30文字以内で入力してください'
			)
		),
		
		//パスワードのvalidation
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				//'message' => 'パスワードを入力してください。'
			),
			'between' => array(
				'rule' => array('between', 6, 15),
				//'message' => '6文字以上15文字以内で入力してください'
			)
		),
		
		//パスワードの再入力のvalidation
		'password_check' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				//'message' => 'パスワード(再入力)を入力してください。',
				'last' => true
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password'),
				//'message' => 'パスワード(再入力)がパスワードと異なります。'
			)
		),
		
		//メールアドレスのvalidation
		'email' => array(
			'email' => array(
				'rule' => array('email', true), 
		        'required' => true
		        //'message' => 'メールアドレスを正しく入力してください。'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				//'message' => 'そのユーザーメールアドレスは既に使われています'
			)
		)
	);
	
	//パスワード同一チェック
	function sameCheck($data, $target) {
		return strcmp(array_shift($data), $this->data[$this->name][$target]) == 0;
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
}
