<?php
App::uses('AppModel', 'Model');
App::uses('AttributesTemplate', 'Model');

class Template extends AppModel {
	  
	public $belongsTo = array('User');

	public $hasAndBelongsToMany = array(
		'Attribute' => array(
                // 'className'              => 'Attribute',
                // 'joinTable'              => 'attributes_templates',
                // 'foreignKey'             => 'template_id',
                // 'associationForeignKey'  => 'attribute_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => 'Attribute.created',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
	);
	
	public function __construct() {
		parent::__construct();
		$this->AttributeTemplate = ClassRegistry::init('AttributesTemplate');
	}
	
	public $validate = array(
        'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'allowEmpty'=> false,
				'message' => '必須項目です'
			)
		)
    );
	
	public function get_default_templates($user_id = null){
		$arrayTemp = array();
		$movie = array(
			'監督',
			'脚本',
			'製作',
			'音楽',
			'編集',
			'原作',
			'キャスト',
			'原題',
			'上映時間',
			'製作国',
			'興行収入',
			'関連',
			'主題歌'
		);
		$dorama = array(
			'放送期間', 
			'話数', 
			'演出', 
			'シリーズ', 
			'制作', 
			'脚本', 
			'プロデュース',
			'ジャンル', 
			'主題歌', 
			'原作', 
			'キャスト',
			'関連'
		);
		$anime = array(
			'アニメーション制作',
			'監督',
			'原作',
			'ジャンル',
			'放送期間',
			'放送局',
			'話数',
			'関連'
		);
		$novel = array(
			'出版社',
			'ジャンル',
			'著者',
			'ページ数',
			'関連'
		);
		$music = array(
			'関連',
			'ジャンル',
			'時間',
			'作詞',
			'作曲',
			'プロデュース'
		);
		$comic = array(
			'原作',
			'関連',
			'原作者',
			'出版社',
			'作画',
			'巻数',
			'掲載誌',
			'ジャンル'
		);
		
		$arrayTemp = array(
			array(
				'name' => '映画',
				'user_id' => $user_id,
				'attributes' => $movie
			),
			array(
				'name' => 'ドラマ',
				'user_id' => $user_id,
				'attributes' => $dorama
			),
			array(
				'name' => 'アニメ',
				'user_id' => $user_id,
				'attributes' => $anime
			),
			array(
				'name' => '小説',
				'user_id' => $user_id,
				'attributes' => $novel
			),
			array(
				'name' => '音楽',
				'user_id' => $user_id,
				'attributes' => $music
			),
			array(
				'name' => '漫画',
				'user_id' => $user_id,
				'attributes' => $comic
			),
		);
		
		foreach($arrayTemp as $template) {
			$templateData['Template'] = array(
				'name' => $template['name'],
				'user_id' => $user_id
			);
			$this->create();
			$templateResult = $this->save($templateData);
			
			foreach ($template['attributes'] as $attribute) {
				$attributeResult = $this->Attribute->findByName($attribute);
				$attrTemplateData = array(
					'AttributesTemplate' => array(
						'template_id' => $templateResult['Template']['id'],
						'attribute_id' => $attributeResult['Attribute']['id']
					)
				);
				$this->AttributesTemplate->create();
				$this->AttributesTemplate->save($attrTemplateData);
			}
		}
		
		return;
	}
	
	
}
