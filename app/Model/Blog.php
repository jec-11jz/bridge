<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Blog extends AppModel {
	
 	public $hasMany = array(
        'UsedBlogImage' => array(
            'className'     => 'UsedBlogImage',
            'foreignKey'    => 'blog_id',
            'dependent'     => true //true に設定すると、モデルのデータの削除時に関連しているモデル側のデータも削除される。
            // 'conditions'    => //hasMany で取得したいデータの条件を指定する。 SQL の条件文。
            // 'order'         =>'User.created DESC' //関連するモデルのデータの並び順。SQL の ORDER 句の指定方法。テーブル名をカラム名の前に付ける
            // 'limit'         => 5 //Cake が取り出す関連モデルのデータの最大数。
            
        )
    );
	
	 public $belognsTo = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey'   => 'user_id',
            'department' => 'true'
        )
    );
	
	public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
	
	public function isOwnedBy($post, $user) {
    	return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
	}
	
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
	
	public function afterSave($create, $options = array()){
		$imgSources = $this->getImageFromHtml($this->data['Blog']['content']);
		foreach ($imgSources as $url) {
			$UsedBlogImage = ClassRegistry::init('UsedBlogImage');
			$UsedBlogImage->create();
			$UsedBlogImage->set(
				array(
					'blog_id' => $this->data['Blog']['id'],
					'user_id' => $this->data['Blog']['user_id'],
					'url' => $url));
			$UsedBlogImage->save();
		}			
		return true;
	}
}
?>