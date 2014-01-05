<?php
App::uses('AppModel', 'Model');
App::uses('BlogTag', 'Model');
App::uses('Tag', 'Model');

class Blog extends AppModel {
	
 	public $hasMany = array(
        'UsedBlogImage' => array(
            'className'     => 'UsedBlogImage',
            'foreignKey'    => 'blog_id',
            'dependent'     => true
        ),
        'BlogTag' => array(
            'className'     => 'BlogTag',
            'foreignKey'    => 'blog_id',
            'dependent'     => true
        )
    );
	
	 public $belongsTo = array('User');
	
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

	public function afterFind($results, $primary = false) {
		$Tag = ClassRegistry::init('Tag');
		foreach ($results as &$result) {
			//$result['Tag'] = $Tag->findAllByBlogId($result['Blog']['id']);
		}
		return $results;
	}

}
?>
