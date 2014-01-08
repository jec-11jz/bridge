<?php
App::uses('AppModel', 'Model');
App::uses('BlogTag', 'Model');
App::uses('AttributesTag', 'Model');

class Tag extends AppModel {

	public $validate = array(
		'name' => array(
			'rule' => 'isUnique',
			'message' => 'duplicated'
		)
	);


	/**
	 * 作品と結びついたタグを取得する
	 *
	 */
	public function findAllByAttributeIdAndProductId($attribute_id, $product_id) {
		$AttributesTag = ClassRegistry::init('AttributesTag');
		$attributesTags = $AttributesTag->findAllByAttributeIdAndProductId($attribute_id, $product_id);

		$tags = array();
		foreach ($attributesTags as $attributesTag) {
			array_push($tags, $attributesTag['Tag']);
		}
		return $tags;
	}

	/**
	 * 最頻出のタグを取得する
	 *
	 * 現在はタグを10,000件取得してるのみ
	 */
	public function getMostUsedTags() {

		$tags = $this->find('list', array(
				'fields' => array('Tag.name'),
				'order' => array('Tag.count DESC', 'Tag.created'),
				'limit' => 10000
			)
		);
		
		return array_values($tags);
	}

	public function parseTagCSV($tagNames = '') {
		$tags = explode(',', $tagNames);
		foreach ($tags as &$tag) {
			$tag = trim($tag);
		}
		unset($tag);
		return $tags;
	}

	public function saveFromNameArray($tags = array()) {
		foreach ($tags as $tag) {
			$this->create();
			$this->set('name', $tag);
			$this->save();
		}
		return true;
	}

	// no used
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
			array_push($tagNames, $tag['name']);
		}
		return $tagNames;
	}

}
