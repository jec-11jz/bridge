<?php
class ImagesController extends AppController {
	public $layout = 'menu';
		
	public function beforeFilter()
    {
    	//親クラス（AppController）読み込み
        parent::beforeFilter();
		//permitted access before login
        $this->Auth->allow('index', 'contents', 'add');
    }
	 
	  public $helpers    = array ( 'Html', 'Form', 'Session' );
	  public $components = array ( 'Session' );
	 
	 
	  var $uses = array('Image');
	  function index(){
	    $images = $this->Image->find('all');
	    $this->set(compact('images'));
	  }
	 
	  /**
	   * 画像を登録する
	   */
	  function add(){
	    $limit = 1024 * 1024;
	    debug($this->data);
	 
	    // 画像の容量チェック
	    if ($this->data['Image']['image']['size'] > $limit){
	      $this->Session->setFlash('1MB以内の画像が登録可能です。');
	      $this->redirect('index');
	    }
	    // アップロードされた画像か
	    if (!is_uploaded_file($this->data['Image']['image']['tmp_name'])){
	      $this->Session->setFlash('アップロードされた画像ではありません。');
	      $this->redirect('index');
	    }
	    // 保存
	    $image = array(
	      'Image' => array(
	        'name' => md5(microtime() . '.' . $extension = end(explode('.', $this->data['Image']['image']['name']))),
	        'contents'      => file_get_contents($this->data['Image']['image']['tmp_name']),
	        'original_name' => $this->data['Image']['image']['name'],
	        'filetype'      => $this->data['Image']['image']['type'],
	        'filesize'      => $this->data['Image']['image']['size'],
	      )
	    );
	    $this->Image->save($image);
	    $this->Session->setFlash('画像をアップロードしました。');
	    $this->redirect('index');
	  }
	 
	 
	  function contents($name) {
	  	
	    $this->layout = false;
	    $image = $this->Image->findByName($name);
	    if (empty($image)) {
	      $this->cakeError('error404');
	    }
	    header('Content-type: ' . $image['Image']['filetype'] );
	    echo $image['Image']['contents'];
	  }
	}
?>