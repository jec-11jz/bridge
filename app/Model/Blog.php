<?php
App::uses('AppModel', 'Model');
App::uses('BlogTag', 'Model');
App::uses('Tag', 'Model');

class Blog extends AppModel {
	
	public $belongsTo = array(
		'User' => array(
			'fileds' => array('id', 'name', 'nickname', 'profile', 'created', 'modified')
		)
	);
 	public $hasMany = array('UsedBlogImage');
	public $hasAndBelongsToMany = array('Tag');
	
	public $validate = array(
        'title' => array(
            'blank' => array(
				'rule' => 'blank',
        		'on' => 'create',
        		'required' => true,
        		'message' => 'title_name is empty!'
			)
        )
	);

	public function __construct() {
		parent::__construct();
		$this->UsedBlogImage = ClassRegistry::init('UsedBlogImage');
	}

	public function afterSave($created, $options = array()) {
		$this->UsedBlogImage->saveFromHtml(
			$this->data['Blog']['user_id'], 
       		$this->data['Blog']['id'], 
       		$this->data['Blog']['content']
		);
	}
	
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
