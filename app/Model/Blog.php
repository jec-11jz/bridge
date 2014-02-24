<?php
App::uses('AppModel', 'Model');
App::uses('BlogsTag', 'Model');
App::uses('Tag', 'Model');

class Blog extends AppModel {
	
	public $belongsTo = array(
		'User' => array(
			'fileds' => array('id', 'name', 'nickname', 'profile', 'created', 'modified')
		)
	);
 	public $hasMany = array(
 		'UsedBlogImage' => array(
            'className'     => 'UsedBlogImage',
            'foreignKey'    => 'blog_id',
            'order'         => 'UsedBlogImage.created DESC',
            'dependent'     => true
        ), 
 		'Comment' => array(
            'className'     => 'Comment',
            'foreignKey'    => 'blog_id',
            'order'         => 'Comment.created DESC',
            'dependent'     => true
        ), 
 		'BlogsFavorite' => array(
            'className'     => 'BlogsFavorite',
            'foreignKey'    => 'blog_id',
            'order'         => 'BlogsFavorite.url',
            'dependent'     => true
        ), 
	);
	public $hasAndBelongsToMany = array('Tag');
	
	public $validate = array(
        'title' => array(
            'notEmpty' => array(
				'rule' => 'notEmpty',
        		'on' => 'create',
        		'message' => 'title is empty!'
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
	
	public function getFavList($blogFavorites = array()) {
		$arrayBlogs = array();
		if(is_array($blogFavorites)){
			foreach($blogFavorites as $fav){
				$result = $this->findById($fav['blog_id']);
				array_push($arrayBlogs, $result);
			}
		}
		
		return $arrayBlogs;
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
