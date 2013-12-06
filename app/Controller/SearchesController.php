<?php
class SearchesController extends AppController {
	public $uses = array('Blog', 'User');
	
	public function index(){
		//リクエストがPOSTの場合
		if($this->request->is('post')){
			 //Formの値を取得
			 $condition = $this->request->data['Search']['condition'];
			 if(isset($condition)){
			 	
				//POSTされたデータを曖昧検索
				$data = $this->Blog->find('all',array(
			 		'conditions' => array('title like'=>'%'.$condition.'%')));
			 } else {
			 	$data = $this->Blog->find('all');
			 }
		} else {
			 //POST以外の場合
			 $data = $this->Blog->find('all');
			 
		}
		//データの連想配列をセット
		$this->set('blogs',$data);
	}
}

?>