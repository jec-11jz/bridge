<?php
App::uses('AppModel', 'Model');

class Comment extends AppModel {
	
	public $belognsTo = array('User', 'Blog');
	
	public function saveComment($comment = array()){
		$message = null;
		if(empty($comment['author'])){
			$message = '名前を入力してください。';
		} else if(!empty($comment['comment'])){
			$this->create();
			$this->set(array(
				'blog_id' => $comment['blog_id'],
				'user_id' => $comment['author_id'],
				'url' => $comment['url'],
				'author' => $comment['author'],
				'comment' => $comment['comment'],
			));
			$this->save();
			$message = 'コメントしました。';
		} else {
			$message = 'コメントを記入してください。';
		}
		return $message;
	}
}
?>