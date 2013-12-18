<?php
App::uses('AppModel', 'Model');
App::uses('BlogTag', 'Model');

class Blog extends AppModel {
	
 	public $hasMany = array(
        'UsedBlogImage' => array(
            'className'     => 'UsedBlogImage',
            'foreignKey'    => 'blog_id',
            'dependent'     => true //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 5 //Cake が取り出す関連モデルのデータの最大数。
            
        ),
        'BlogTag' => array(
            'className'     => 'BlogTag',
            'foreignKey'    => 'blog_id',
            'dependent'     => true, //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            //'limit'         => 50 //Cake が取り出す関連モデルのデータの最大数。
            
        )
    );
	
	 public $belognsTo = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey'   => 'user_id',
            'department' => 'true'
        )
    );
	
	public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
	
	public function isOwnedBy($post, $user) {
    	return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
	}
	
	public function getTagNamesFromBlog($blog) {
		$BlogTag = ClassRegistry::init('BlogTag');
		return $BlogTag->getTagNamesFromArray($blog['BlogTag']);
	}

	public function getTagNamesFromBlogs($blogs) {
		$arrayTagNames = array();
		foreach ($blogs as $blog) {
			$tagNames = $this->getTagNamesFromBlog($blog);
			if (!is_array($tagNames)) {
				continue;
			}
			$arrayTagNames = array_merge($arrayTagNames, $tagNames);
		}
		return $arrayTagNames;
	}

}
?>
