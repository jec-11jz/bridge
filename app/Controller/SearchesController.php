<?php

class SearchesController extends AppController {
	public $uses = array('Blog', 'User');
	public $layout = 'menu';
	
	public function index(){
		//リクエストがPOSTの場合
		if($this->request->is('post')){
			 //Formの値を取得
			 if(isset($this->request->data['Search']['condition'])){
			 	$condition = $this->request->data['Search']['condition'];
				//POSTされたデータを曖昧検索
				$data = $this->Blog->find('all',array(
			 		'conditions' => array('title like'=>'%'.$condition.'%')));
				print '1';
			 } else {
			 	$data = $this->Blog->find('all');
				print '2';
			 }
			 $this->set('blogs',$data);
		} else {
			 //POST以外の場合
			 $data = $this->Blog->find('all');
			 //データの連想配列をセット
			 $this->set('blogs',$data);
			 print '3';
		}
		$this->set('blogs',$data);
	}
	
	
}

?>