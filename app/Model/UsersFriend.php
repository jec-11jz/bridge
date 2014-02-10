<?php
App::uses('AppModel', 'Model');

class UsersFriend extends AppModel {
	
	public $belognsTo = array('User');
	
	public function saveFriends ($owner_id = null, $friend_id = null){
		$user_fav = $this->findByOwnerIdAndFriendId($owner_id, $friend_id);
		$message = null;
		if(empty($user_fav)){
			$this->create();
			$this->set(array(
				'owner_id' => $owner_id,
				'friend_id' => $friend_id
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