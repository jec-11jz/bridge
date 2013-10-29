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
	public $belongsTo = array('Group');
	public $actsAs = array('Acl' => array('type' => 'requester'));
	
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}
	
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
	
		//ユーザーIDのvalidation
		'id' => array(
			
		),
		
		//ユーザIDのvalidation
		'name' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
			),
			//働かない
			'custom' => array(
				'rule' => array('custom', '/^[a-z\d]*$/'), 
            ),
            'maxLength' => array(
				'rule' => array('maxLength', '15'),
			)
		),
		
		//ニックネームのvalidation
		'nickname' => array(
			'maxLength' => array(
				'rule' => array('maxLength', '30'),
				'allowEmpty'=>true,
			)
		),
		
		//パスワードのvalidation
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
			),
			'between' => array(
				'rule' => array('between', 6, 15),
			)
		),
		
		//パスワードの再入力のvalidation
		'password_check' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'last' => true
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password'),
			)
		),
		
		//メールアドレスのvalidation
		'email' => array(
			'email' => array(
				'rule' => array('email', true), 
		        'required' => true
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
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
