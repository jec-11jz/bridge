<?php
App::uses('AppModel', 'Model');

class Tag extends AppModel {
	public $hasMany = array(
        'BlogTag' => array(
            'className'     => 'BlogTag',
            'foreignKey'    => 'tag_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        )
    );
	 public $belognsTo = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey'   => 'user_id',
            'department' => 'true'
        )
    );

	public function getTags() {
		$tagList = $this->find('all', array(
				'fields' => array('Tag.name'),
				'order' => array('Tag.count DESC', 'Tag.created'),
				'limit' => 10000
			)
		);
		
		//タグの添字を削除
		$tags = Set::extract('/Tag/name', $tagList);
		return $tags;
	}
	
	public function addTags($tag_name, $user_id){
    	if(!empty($tag_name)){
			//送らてきたタグのカンマで区切られた文字列を分解す
			$tags = explode(",", $tag_name);
			foreach ($tags as $tag) {
				$tag = trim($tag);
				if($this->findByName($tag)){
					//DBに存在するタグは登録しない
				} else {
					// 新規レコード生成
		            $this->create();
					$this->set(array('name'=>$tag, 'user_id'=>$user_id));
		            $this->save();
				}
			}
    	}
		return true;
    }
}
?>