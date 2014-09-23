<?php
/**
 * Part of Windwalker project Test files.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Session\Test\Handler;

use Windwalker\Database\Test\AbstractDatabaseCase;
use Windwalker\Session\Database\WindwalkerAdapter;
use Windwalker\Session\Handler\DatabaseHandler;

/**
 * Test class of DatabaseHandler
 *
 * @since {DEPLOY_VERSION}
 */
class DatabaseHandlerTest extends AbstractDatabaseCase
{
	/**
	 * Property driver.
	 *
	 * @var string
	 */
	protected static $driver = 'mysql';

	/**
	 * Test instance.
	 *
	 * @var DatabaseHandler
	 */
	protected $instance;

	/**
	 * setUpBeforeClass
	 *
	 * @return  void
	 */
	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();

		static::$dbo->getTable('windwalker_sessions')
			->addColumn('id', 'varchar(255)', true, false, null, '')
			->addColumn('data', 'text')
			->addColumn('time', 'varchar(255)')
			->save();
	}

	/**
	 * tearDownAfterClass
	 *
	 * @return  void
	 */
	public static function tearDownAfterClass()
	{
		parent::tearDownAfterClass();
	}

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->instance = new DatabaseHandler(new WindwalkerAdapter(static::$dbo));
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{

	}

	/**
	 * Method to test open().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Session\Handler\DatabaseHandler::open
	 * @TODO   Implement testOpen().
	 */
	public function testOpen()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * Method to test close().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Session\Handler\DatabaseHandler::close
	 * @TODO   Implement testClose().
	 */
	public function testClose()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * Method to test read().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Session\Handler\DatabaseHandler::read
	 */
	public function testReadAndWrite()
	{
		$this->instance->write('id', 'foo');

		$this->assertEquals('foo', $this->instance->read('id'));
	}

	/**
	 * Method to test destroy().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Session\Handler\DatabaseHandler::destroy
	 * @TODO   Implement testDestroy().
	 */
	public function testDestroy()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * Method to test gc().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Session\Handler\DatabaseHandler::gc
	 * @TODO   Implement testGc().
	 */
	public function testGc()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * Method to test isSupported().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Session\Handler\DatabaseHandler::isSupported
	 * @TODO   Implement testIsSupported().
	 */
	public function testIsSupported()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}
}
