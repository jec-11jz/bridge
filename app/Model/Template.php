<?php
App::uses('AppModel', 'Model');

class Template extends AppModel {
	public $hasMany = array(
        'Attribute' => array(
            'className'     => 'Attribute',
            'foreignKey'    => 'template_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            //'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        )
    );
	public $belognsTo = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey'   => 'user_id'
        )
    );
	
	public $validate = array(
        'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'allowEmpty'=>false
			)
		)
    );
	
}
?>