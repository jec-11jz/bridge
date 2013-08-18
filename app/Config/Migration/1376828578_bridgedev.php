<?php
class BridgeDev extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'diaries' => array(
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'thumbnail'),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'created'),
				),
				'users' => array(
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'password'),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'created'),
				),
			),
			'drop_field' => array(
				'diaries' => array('created_at', 'updated_at',),
				'users' => array('created_at', 'updated_at',),
			),
		),
		'down' => array(
			'drop_field' => array(
				'diaries' => array('created', 'modified',),
				'users' => array('created', 'modified',),
			),
			'create_field' => array(
				'diaries' => array(
					'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
				),
				'users' => array(
					'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
				),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
