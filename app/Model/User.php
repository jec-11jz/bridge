<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('EmailAuth', 'Model');
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
            'className'     => 'Blog',
            'foreignKey'    => 'user_id',
            'dependent'     => true //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 5 //Cake が取り出す関連モデルのデータの最大数。
            
        )
    );
	public $validate = array(
		'id' => array(),
		'name' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'last' => true,
				'message' => 'そのユーザーIDは既に使われています',
			),
			'custom' => array(
				'rule' => array('custom', '/^[a-z\d]*$/'), 
				'last' => true,
				'message' => '半角英数字のみ使用できます',
            ),
            'maxLength' => array(
				'rule' => array('maxLength', '15'),
				'message' => '15文字以内で入力してください',
			),
			'notEmpty' => array(
				'rule' => 'notEmpty'
			)
		),
		'nickname' => array(
			'maxLength' => array(
				'rule' => array('maxLength', '30'),
				'allowEmpty'=>true,
				'last' => false,
				'message' => ''
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'last' => true,
				'message' => 'パスワードを入力してください。'
			),
			'between' => array(
				'rule' => array('between', 6, 15),
				'message' => '6文字以上15文字以内で入力してください'
			)
		),
		'password_check' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'last' => true,
				'message' => 'パスワード(再入力)を入力してください。'
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password'),
				'message' => 'パスワード(再入力)がパスワードと異なります。'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => array('email', true), 
		        'required' => false,
		        'last' => true,
		        'message' => 'メールアドレスを正しく入力してください。'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'そのメールアドレスは既に使用されています'
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '15文字以内で入力してください'
			)
		)
	);

	/**
	 * パスワードが同じかチェックする
	 *
	 * @param array $data フィールドとそのデータの連想配列
	 * @param string $target 同一チェックの対象フィールド
	 * @return boolean 同じかどうか
	 *
	 */
	function sameCheck($data, $target) {
		return strcmp(array_shift($data), $this->data[$this->name][$target]) == 0;
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	public function afterSave($created, $options = array()) {
        if ($created) {
			$EmailAuth = ClassRegistry::init('EmailAuth');
			$emailAuth = $EmailAuth->createRecord($this->getLastInsertId());
		}
	} 
	
	
	/**
	 * メールアドレス認証済みにする
	 *
	 * @param string $id 対象のユーザID
	 * @return boolean 認証が成功したかどうか
	 */
	public function chengeEmailVerifiedToTrue($id) {
		$user = $this->findById($id);
		if (!$user) {
			return false;
		}
		$this->create();
		$data = array('User' => array('id' => $id, 'email_verified' => true));
		$feildList = array('email_verified');
		$result = $this->save($data, false, $feildList);
		if (!$result) {
			return false;
		}
		return true;
    }

}
