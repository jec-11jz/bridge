<?php
App::uses('AppModel', 'Model');
App::uses('Blog', 'Model');

class Search extends AppModel {
	
	public function nullCheckOfKeywords($keywords = array()) {
		foreach($keywords as $keyword) {
			if(isset($keyword)){
				return true;
			}
		}
		return false;
	}
	
	public function createSQL($keywords = array()) {
		// blog
		$Blog = ClassRegistry::init('Blog'); 
		
		$keywordTitleQuery = $Blog->find('all',array(
			'conditions' => array(
				'title like'=>'%'.$keywords['keyword'].'%',
				'OR' => array(
					'content like'=>'%'.$keywords['keyword'].'%',
				)
			),
		));
		$notKeyTitleQuery = $Blog->find('all',array(
			'conditions' => array('title like'=>'%'.$keywords['not_key'].'%'),
		));
		$orKeyQuery = $Blog->find('all',array(
			'conditions' => array('title like'=>'%'.$keywords['or_key'].'%'),
		));
		
		$subQuery = $blog_db->buildStatement(
		    array(
		        'alias'      => 'Blog2',
		        'joins'      => array(),
		        'conditions' => $keywords['key_and']
		    ),
	    	$this->Blog
		);
		
		// product
		$product_db = $this->Product->getDataSource();
		
	}
}