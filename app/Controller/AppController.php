<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $layout = 'menu';
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array (
                    'fields' => array('username' => 'email'),
                    'userModel' => 'User'
                )
            ),
                'loginRedirect' => array('controller'  => 'home', 'action' => 'index'),
                'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
                'loginAction' => array('controller' => 'home', 'action' => 'index'),
        ),
        'DebugKit.Toolbar',
        // 'authorize' => array('Controller')
	);
	
	
	public function isAuthorized($user) {
	    // if (isset($user['group_id']) && $user['group_id'] === '2') {
	        // return true;
	    // }
	    // デフォルトは拒否
	    return false;
	}
		
	
	public function beforeRender(){
		$this->set('user', $this->Auth->user());
		$this->response->disableCache();
	}

	
	protected $apiResult = array();

	protected function apiSuccess($response = array()) {
		$this->apiResult['response'] = $response;

		$this->set('response', $this->apiResult['response']);
		$this->set('_serialize', array('response'));
	}
	
	protected function apiError($message = '', $errorCode = 0, $statusCode = 400) {
		$this->apiResult['error']['message'] = $message;
		$this->apiResult['error']['code'] = $errorCode;

		$this->response->statusCode($statusCode);
		$this->set('error', $this->apiResult['error']);
		$this->set('_serialize', array('error'));
	}


	protected function apiValidationError($modelName, $validationError = array()) {
		$this->apiResult['error']['message'] = 'Validation Error';
		$this->apiResult['error']['code']    = 422;
		$this->apiResult['error']['validation'][$modelName] = array();
		foreach ($validationError as $key => $value) {
			$this->apiResult['error']['validation'][$modelName][$key] = $value[0];
		}
		 
		$this->response->statusCode(400);
		$this->set('error', $this->apiResult['error']);
		$this->set('_serialize', array('error'));
	}
}
