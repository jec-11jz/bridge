<?php
App::uses('AppModel', 'Model');
App::uses('Attribuute', 'Model');

class Template extends AppModel {
	public $hasMany = array(
        'TemplateAttribute' => array(
            'className'     => 'TemplateAttribute',
            'foreignKey'    => 'template_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            //'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        ),
        'Product' => array(
            'className'     => 'Product',
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
	
	public function findAllWithAttributeByUserId($user_id) {
		$templates = $this->findAllByUserId($user_id);
		if (!is_array($templates)) {
			return false;
		}
		
		$Attribute = ClassRegistry::init('Attribute');
		foreach ($templates as &$template) {
			$template['Attribute'] = $Attribute->findAllByTemplateId($template['Template']['id']);
		}
		unset($template);
		return $templates;
	}
	
}
?>