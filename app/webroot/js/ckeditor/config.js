/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	CKEDITOR.config.width = '100%'; //横幅
	CKEDITOR.config.height = '30em'; //高さ
	CKEDITOR.config.resize_enabled = true;
	CKEDITOR.config.toolbar = [
		['Source']
		,['Save','Print','Preview','-','Templates']
		,['Undo','Redo','-','Find','-','SelectAll','RemoveFormat']
		,['Cut','Copy','Paste','PasteText','PasteFromWord','-','SpellChecker']
		,'/'
		,['Font','FontSize']
		,['Subscript','Superscript']
		,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']
		,['Checkbox','Radio','Select']
		,['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak']
		,'/'
		,['Bold','Italic','Underline','Strike']
		,['Format']
		,['TextColor','BGColor']
		,['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']
		,['Link','Unlink','Anchor']
		,['ShowBlocks']
	];
	
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
