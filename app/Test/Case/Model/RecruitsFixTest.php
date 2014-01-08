<?php
App::uses('RecruitsFix', 'Model');

/**
 * RecruitsFix Test Case
 *
 */
class RecruitsFixTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recruits_fix'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RecruitsFix = ClassRegistry::init('RecruitsFix');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RecruitsFix);

		parent::tearDown();
	}

}
