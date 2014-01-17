/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	CKEDITOR.config.width = '95%'; //横幅
	CKEDITOR.config.height = '20em'; //高さ
	CKEDITOR.config.resize_enabled = true;
	CKEDITOR.config.toolbar = [
		['Source','-','Save','NewPage','Preview','-','Templates']
		,['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker']
		,['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat']
		,['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField']
		,'/'
		,['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']
		,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']
		,['Link','Unlink','Anchor']
		,['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak']
		,'/'
		,['Styles','Format','Font','FontSize']
		,['Bold','Italic','Underline','Strike','-','Subscript','Superscript']
		,['TextColor','BGColor']
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
