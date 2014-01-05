<?php
App::uses('AppModel', 'Model');

class TemplateAttribute extends AppModel {
	public $belongsTo = array('Attribute', 'Template');
}
?>