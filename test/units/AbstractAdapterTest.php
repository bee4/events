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

/**
 * Check behaviour Événement EventEmitter adapter
 * @package Bee4\Test\Events
 */
abstract class AbstractAdapterTest extends \PHPUnit_Framework_TestCase {

	protected $adapter;

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage Yes event triggered
	 */
	public function testAdapter() {
		$handler = function() { echo "Youpi!"; };
		$event = $this->getMock('Bee4\Events\EventInterface');

		$this->expectOutputString('Youpi!');

		$this->adapter->add('name', $handler);
		$this->adapter->dispatch('name', $event);

		$this->adapter->add('name', function() {
			throw new \Exception('Yes event triggered');
		});

		$this->assertCount(2, $this->adapter->get('name'));
		$this->adapter->remove('name', $handler);
		$this->assertCount(1, $this->adapter->get('name'));

		$this->adapter->dispatch('name', $event);
	}
}
