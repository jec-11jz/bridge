<?php
App::uses('AppModel', 'Model');
App::uses('Tag', 'Model');

class Search extends AppModel {
	
	public function __construct() {
		parent::__construct();
		$this->Tag = ClassRegistry::init('Tag');
	}
	
	public function nullCheckOfKeywords($keywords = array()) {
		foreach($keywords as $keyword) {
			if(isset($keyword)){
				return true;
			}
		}
		return false;
	}
	
	public function mergeBlogTagsAndProductTags ($contents = array()){
		$tag_ids = array();
		// merge tag_id used by blogs
		foreach($contents['blogs'] as $blog){
			foreach($blog['Tag'] as $blog_tag){
				array_push($tag_ids, $blog_tag['id']);
			}
		}
		// merge tag_id used by attributes of products
		foreach($contents['products'] as $product){
			foreach($product['AttributesTag'] as $attr_tag){
				array_push($tag_ids, $attr_tag['tag_id']);
			}
			foreach($product['ProductsTag'] as $product_tag){
				array_push($tag_ids, $product_tag['tag_id']);
			}
		}
		$tag_ids = array_count_values($tag_ids);
		$tag_ids = $this->getMostUsedTagIds($tag_ids);
		$tags = $this->Tag->findAllById($tag_ids);
		return $tags;
	}
	public function getMostUsedTagIds($count_values = array()) {
		$tag_ids = array();
		$arrayCount = count($count_values);
		if(count($count_values) >= 10){
			$arrayCount = 10;
		} else if(count($count_values) <= 0){
			$arrayCount = 0;
		}
		for($count = 0; $count < $arrayCount; $count++){
			$tag_ids[$count] = array_search(max($count_values), $count_values);
			unset($count_values[$tag_ids[$count]]);
		}
		
		return $tag_ids;
	}
}