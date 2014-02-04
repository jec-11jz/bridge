<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
App::uses('Blog', 'Model');

class BlogsFavorite extends AppModel {
	
	public $belognsTo = array('User', 'Blog');
	
	public function saveUsersBlogs ($blog_id = null, $user_id = null){
		$user_fav = $this->findByUserIdAndBlogId($user_id, $blog_id);
		$message = null;
		if(empty($user_fav)){
			$this->create();
			$this->set(array(
				'blog_id' => $blog_id,
				'user_id' => $user_id
			));
			$this->save();
			$message = 'お気に入りに追加しました。';
		} else {
			$message = 'すでにお気に入りに追加済みです。';
		}
		return $message;
	}
}
?>