<?php
App::uses('AppModel', 'Model');

class UsedBlogImage extends AppModel {

	public $belognsTo = array('User', 'Blog');

	public function getImageFromHtml($htmlText){
		$dom = new DOMDocument();
		$dom->loadHTML($htmlText);
		$els = $dom->getElementsByTagName('img');
		$imgSources = array();
		foreach ($els as $el) {
			array_push($imgSources, $el->getAttribute('src'));
		}
		return $imgSources;
	}

	public function saveFromHtml($user_id, $blog_id, $content) {
		$this->deleteAll(array('Blog_id'=>$blog_id));
		if(!empty($content)){
			// img tag 抜き出し
			$imgSources = $this->getImageFromHtml($content);
			// セーブ
			foreach ($imgSources as $url) {
				$this->create();
				$this->set(array(
					'blog_id' => $blog_id,
					'user_id' => $user_id,
					'url' => $url
				));
				$this->save();
			}					
			return true;
		}
	}
	
}
?>
