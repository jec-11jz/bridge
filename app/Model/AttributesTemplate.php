<?php
App::uses('AppModel', 'Model');

class AttributesTemplate extends AppModel {
	public $belongsTo = array('Attribute', 'Template');
}
