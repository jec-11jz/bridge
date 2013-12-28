<?php
App::uses('AppModel', 'Model');

class Product extends AppModel {
	
	public $hasMany = array(
        'ProductTag' => array(
            'className'     => 'ProductTag',
            'foreignKey'    => 'product_id',
            'dependent'     => true //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 5 //Cake が取り出す関連モデルのデータの最大数。
            
        ),
        'AttributeTag' => array(
            'className'     => 'AttributeTag',
            'foreignKey'    => 'product_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            //'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。
            
        )
    );
	
    public $belongsTo = array('User', 'Template');
	
	public function getRelationedAttributeByid($id) {
		
	}
}
?>