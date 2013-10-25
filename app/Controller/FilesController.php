<?php
if (!defined('ELFINDER_DIR')) {
  // According to your server path and setup        
  define ('ELFINDER_DIR', ROOT . DS . 'public_html/files/media' . DS);
}
if (!defined('ELFINDER_URL')) {
  // According to your domain and setup     
  define ('ELFINDER_URL', 'http://domain.com'. DS . 'files' . DS . 'media' . DS);
}
App::uses('AppController', 'Controller');
require_once APP . 'Lib'. DS. 'Elfinder'. DS. 'elFinderConnector.class.php';
require_once APP . 'Lib'. DS. 'Elfinder'. DS. 'elFinder.class.php';
require_once APP . 'Lib'. DS. 'Elfinder'. DS. 'elFinderVolumeDriver.class.php';
require_once APP . 'Lib'. DS. 'Elfinder'. DS. 'elFinderVolumeLocalFileSystem.class.php';
class FilesController extends AppController {
    public $name = 'Files';
    public $uses = array();
    public $components = array('RequestHandler');
    public $helpers = array('Js', 'Html');
    public $opts = array(
            //'debug' => false,
            'roots' => array(
                array(
                    'driver'        => 'LocalFileSystem',    // driver for accessing file system (REQUIRED)
                    'path'          => ELFINDER_DIR,             // path to files (REQUIRED)
                    'URL'           => ELFINDER_URL,             // URL to files (REQUIRED)
                    'tmbBgColor'    => 'transparent'
                )
            )
        );
 
    public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('admin_index', 'add', 'view');
        // $this->Security->csrfCheck = false;
        // $this->Security->validatePost = false;
    }
 
    public function admin_index() {
        $title_for_layout = 'Media Library';
        $this->set(compact('title_for_layout'));
 
        if($this->RequestHandler->isAjax() || $this->RequestHandler->isPost()) {
            $connector = new ElFinderConnector(new ElFinder($this->opts));
            $connector->run();
        }
 
    }
}