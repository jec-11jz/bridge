<?php
App::uses('AppModel', 'Model');
App::uses('Tag', 'Model');

class BlogsTag extends AppModel {
	public $belongsTo = array('Tag', 'Blog');

	
	public function addBlogTags($tag_name, $blog_id){
		$Tag = ClassRegistry::init('Tag');
    	if(isset($tag_name)){
			//送らてきたタグのカンマで区切られた文字列を分解する
			$tags = explode(",", $tag_name);
			foreach ($tags as $tag) {
				$tag = trim($tag);
				$result = $Tag->findByName($tag);
				if($result) {
					// 新規レコード生成
		            $this->create();
					$this->set(array(
						'tag_id'=>$result['Tag']['id'], 
						'blog_id'=>$blog_id));
		            $this->save();
				}
			}
    	}
		return true;
    }
	
	public function getTagNamesFromArray($blogTags) {
		$Tag = ClassRegistry::init('Tag');
		$tagNames = array();
		foreach($blogTags as $blogTag) {
			$tag = $Tag->findById($blogTag['tag_id']);
			if (!is_array($tag)) {
				// TODO: エラー処理する
				return false;
			}
			array_push($tagNames, $tag['Tag']['name']);
		}
		return $tagNames;
	}
	
}
