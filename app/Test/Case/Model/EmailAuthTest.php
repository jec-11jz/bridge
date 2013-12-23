<?php
App::uses('EmailAuth', 'Model');

/**
 * EmailAuth Test Case
 *
 */
class EmailAuthTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.email_auth',
		'app.user',
		'app.blog',
		'app.used_blog_image',
		'app.blog_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EmailAuth = ClassRegistry::init('EmailAuth');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EmailAuth);

		parent::tearDown();
	}

/**
 * testCreateRecord method
 *
 * @return void
 */
	public function testCreateRecord() {
	}

/**
 * testCheckValid method
 *
 * @return void
 */
	public function testCheckValid() {
	}

/**
 * testFindByUserAndToken method
 *
 * @return void
 */
	public function testFindByUserAndToken() {
	}

}
