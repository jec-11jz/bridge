<?php
App::uses('AppModel', 'Model');

class UsedBlogImage extends AppModel {

	public function getImageFromHtml($htmlText){
		$dom = new DOMDocument();
		//$doc->loadHTML('<html></html>');
		//$doc->loadHTMLFile('/path/to/index.html');
		$dom->loadHTML($htmlText);
		$els = $dom->getElementsByTagName('img');
		$imgSources = array();
		foreach ($els as $el) {
			array_push($imgSources, $el->getAttribute('src'));
			//$el -> getAttribute('name');
		}
		return $imgSources;
	}

	public function saveFromHtml($user_id, $blog_id, $content) {
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
?>