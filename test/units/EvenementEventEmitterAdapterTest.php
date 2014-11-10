<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2014
 * @author  Stephane HULARD <s.hulard@chstudio.fr>
 * @package Bee4\Test\Events
 */

namespace Bee4\Test\Events;

use Bee4\Events\Adapters\EvenementEventEmitterAdapter;

/**
 * Check behaviour Événement EventEmitter adapter
 * @package Bee4\Test\Events
 */
class EvenementEventEmitterAdapterTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var \Evenement\EventEmitter
	 */
	protected $dispatcher;

	protected function setUp() {
		if( !class_exists("Evenement\EventEmitter") ) {
			$this->markTestSkipped('You must install dev dependencies to be able run tests!');
		}

		$this->dispatcher = new \Evenement\EventEmitter();
	}

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage Yes event triggered
	 */
	public function testAdapter() {
		$adapter = new EvenementEventEmitterAdapter($this->dispatcher);
		$handler = function() { echo "Youpi!"; };
		$event = $this->getMock('Bee4\Events\EventInterface');

		$this->expectOutputString('Youpi!');

		$adapter->add('name', $handler);
		$adapter->dispatch('name', $event);

		$adapter->add('name', function() {
			throw new \Exception('Yes event triggered');
		});

		$this->assertCount(2, $adapter->get('name'));
		$adapter->remove('name', $handler);
		$this->assertCount(1, $adapter->get('name'));

		$adapter->dispatch('name', $event);
	}
}
