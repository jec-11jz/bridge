<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

// IMPORTANT!!! Do not remove uncommented settings in this file even if
// you are using session configuration.
// See http://kcfinder.sunhater.com/install for setting descriptions

error_reporting(E_ALL & ~E_NOTICE);
session_name('CAKEPHP');
session_start();


global $_CONFIG;
$_CONFIG = array(

    'disabled' => false,
    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,

    // 'theme' => "oxygen",
    'theme' => "dark",

    // 'uploadURL' => "upload",
    'uploadURL' => "/upload/",
    'uploadDir' => "../../upload/",

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true
        ),

        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),

    'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",

    'types' => array(

        // CKEditor & FCKEditor types
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",

        // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),

    'filenameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'thumbsDir' => ".thumbs",

    'jpegQuality' => 90,

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    '_check4htaccess' => true,
    //'_tinyMCEPath' => "/tiny_mce",

    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
    
    '_sessionVar' => &$_SESSION['KCFINDER'],
    '_sessionLifetime' => 30,
    '_sessionDir' => "/Applications/MAMP/tmp/php",	// SESSIONファイル保存先。phpinfo();とかで出てくる「session.save_path」のこと。ここの例はCentOSでのデフォルトなので各自書き換えて！

    '_sessionDomain' => ".bridge.com",	// 配置する場所のドメイン名
    '_sessionPath' => "/kcfinder",	// kcfinder置き場
    
);

//  ユーザー認証
if (!function_exists('KCF_CheckAuthentication')) {
    function KCF_CheckAuthentication()
    {
        global $_CONFIG;


        // ここらへんで適当に認証処理します。
        // 認証成功するとアカウントIDを返し、失敗するとfalseを返すメソッドを実行したとします。
        $old_session_name = session_name();
        
        $account = $_SESSION['Auth']['User']['id'];
		// session_name($old_session_name);
		// session_start();
        if ($account) {
            //認証成功時に必要な処理があればする。IDを桁数揃えるとか。
        } else {
            // 認証失敗時はfalseを返して終了。
            
            return false;
        }

        // uploadsフォルダの下にアカウントごとにフォルダを作ってファイルを置くとします。
        $updir = '../../upload/'.$account.'/';
        // 先にフォルダを作成しておきます。
        if (!is_dir($updir)) {
            mkdir($updir);
            chmod($updir, 0757);
        }

        // uploadURLなどをそのユーザー用の位置にセットします。
        $_CONFIG['uploadURL'] = "/upload/".$account;
        $_CONFIG['uploadDir'] = $updir;

        return true;
    }
}

// ユーザー認証の実行
$_CONFIG['disabled'] = !KCF_CheckAuthentication();

?>
