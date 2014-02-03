<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
App::uses('Product', 'Model');

class Productsfavorite extends AppModel {
	
	public $belognsTo = array('User', 'Product');
}
?>