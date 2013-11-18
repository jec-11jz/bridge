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
    
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array (
                    'fields' => array('username' => 'email'),
                    'userModel' => 'User'
                )
            ),
            	//ログイン後のリダイレクト先
                'loginRedirect' => array('controller'  => 'home', 'action' => 'index'),
                //ログアウト後のリダイレクト先
                'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
                //ログインしていない場合のリダイレクト先
                'loginAction' => array('controller' => 'home', 'action' => 'index'),
                //ログインにデフォルトの username ではなく email を使うためここで書き換えています			
        ),
        'DebugKit.Toolbar'
    );
	
	//現在はtrueで返している
	public function isAuthorized($user) {
        $result = false;
        if ( 'グループIDの判定処理をココに書く' ) {
            $result = true; //成功→ loginRedirectへリダイレクト
        }
        return $result;
    }
	
	public function beforeRender(){
		$this->set('user', $this->Auth->user());
	}
	
    
}
