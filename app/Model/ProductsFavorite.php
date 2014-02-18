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
			$this->create();
			$this->set(array(
				'product_id' => $product_id,
				'user_id' => $user_id,
				'status' => $status
			));
			$this->save();
			$message = '+1';
		} else {
			$message = 'すでに追加済みです';
		}
		return $message;
	}
}
?>