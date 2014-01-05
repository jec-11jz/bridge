<?php
App::uses('AppModel', 'Model');
App::uses('BlogTag', 'Model');

class Tag extends AppModel {
	public $hasMany = array(
        'BlogTag' => array(
            'className'     => 'BlogTag',
            'foreignKey'    => 'tag_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        ),
        'AttributeTag' => array(
            'className'     => 'AttributeTag',
            'foreignKey'    => 'tag_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        ),
        'ProductTag' => array(
            'className'     => 'ProductTag',
            'foreignKey'    => 'tag_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。 
        )
    );
	 public $belongsTo = array('User');

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
	
	public function addTags($tag_name, $user_id, $tag_type){
    	if(isset($tag_name)){
			//送らてきたタグのカンマで区切られた文字列を分解す
			$tags = explode(",", $tag_name);
			foreach ($tags as $tag) {
				$tag = trim($tag);
				if($this->findByName($tag) || !isset($tag)){
					//setされていない又はDBに存在するタグは登録しない
				} else {
					// 新規レコード生成
		            $this->create();
					$this->set(array(
						'name'=>$tag, 'user_id'=>$user_id, 'tag_type'=>$tag_type
					));
		            $this->save();
				}
			}
    	}
		return true;
    }
	
	public function tagNamesToCSV($tags) {
		$tagNames = $this->getNamesFromTags($tags);
		return implode(', ', $tagNames);
	}
	
	public function getNamesFromTags($tags) {
		$tagNames = array();
		foreach ($tags as $tag) {
			array_push($tagNames, $tag['Tag']['name']);
		}
		return $tagNames;
	}

	public function findAllByBlogId($blog_id) {
		$BlogTag = ClassRegistry::init('BlogTag');
		$blogTags = $BlogTag->findAllByBlogId($blog_id);
		return false;

		$tags = array();
		foreach ($blogTags as $blogTag) {
			array_push($tags, $blogTag);
		}
		return $tags;
	}
}
