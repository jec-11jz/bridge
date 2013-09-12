<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends Model {

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
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				//'message' => 'そのユーザーIDは既に使われています'
			),
			'alphanumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                //'message' => '半角英数字のみ使用できます'
            ),
            'minLength' => array(
				'rule' => array('minLength', '15'),
				'required' => true,
				//'message' => '15文字以内で入力してください'
			)
		),
		
		//ユーザー名のvalidation
		'nickname' => array(
			'allowEmpty' => array(
				'rule' => array('allowEmpty',true)
			),
			'maxLength' => array(
				'rule'=>array('maxLength', '30'),
				//'message'=>'30文字以内で入力してください'
			),
		),
		
		//パスワードのvalidation
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				//'message' => 'パスワードを入力してください。'
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
	        'rule' => array('email', true),
	        //'message' => 'メールアドレスを正しく入力してください。'
			)
	);
	
	//パスワード同一チェック
	function sameCheck($data, $target) {
		return strcmp(array_shift($data), $this->data[$this->name][$target]) == 0;
	}
}
