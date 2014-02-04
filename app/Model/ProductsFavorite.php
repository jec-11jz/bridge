<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
App::uses('Product', 'Model');

class ProductsFavorite extends AppModel {
	
	public $belognsTo = array('User', 'Product');
	
	public function saveUsersProducts ($product_id = null, $user_id = null, $status = null){
		$user_fav = $this->findByUserIdAndProductIdAndStatus($user_id, $product_id, $status);
		$message = null;
		if(empty($user_fav)){
			$this->set(array(
				'product_id' => $product_id,
				'user_id' => $user_id,
				'status' => $status
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