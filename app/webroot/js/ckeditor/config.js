/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	CKEDITOR.config.width = '60%'; //横幅
	CKEDITOR.config.height = '40%'; //高さ
	CKEDITOR.config.resize_enabled = true;
	
	//CKEditorにKCFinderを認識させるコード
	config.language = 'ja';
	config.filebrowserBrowseUrl = '/js/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/js/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/js/kcfinder/browse.php?type=flash';
   	config.filebrowserUploadUrl = '/js/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/js/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/js/kcfinder/upload.php?type=flash';

	config.skin = 'moonocolor';
};
