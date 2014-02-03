<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
App::uses('Blog', 'Model');

class BlogsFavorite extends AppModel {
	
	public $belognsTo = array('User', 'Blog');
}
?>