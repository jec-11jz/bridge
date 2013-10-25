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
 	public $name = 'User';
 	public $hasMany = array(
        'Blog' => array(
            'className'     => 'Blog', //関連付けたいモデルのクラス名
            'foreignKey'    => 'user_id',
            'dependent'     => true //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 5 //Cake が取り出す関連モデルのデータの最大数。
            
        )
    );
	public $validate = array(
	
		//ユーザーIDのvalidation
		'id' => array(
			
		),
		
		//ユーザIDのvalidation
		'name' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				//'message' => 'そのユーザーIDは既に使われています'
			),
			//働かない
			'custom' => array(
				'rule' => array('custom', '/^[a-z\d]*$/'), 
				//'message' => '半角英数字じゃない'
            ),
            'maxLength' => array(
				'rule' => array('maxLength', '15'),
				//'message' => '15文字以内で入力してください'
			)
		),
		
		//ニックネームのvalidation
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
	
	//パスワードのハッシュ化
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

}
