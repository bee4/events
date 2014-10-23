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

use Bee4\Events\Adapters\SymfonyEventDispatcherAdapter;

/**
 * Check behaviour SF2 EventDispatcher adapter
 * @package Bee4\Test\Events
 */
class SymfonyEventDispatcherAdapterTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var \Symfony\Component\EventDispatcher\EventDispatcher
	 */
	protected $dispatcher;

	protected function setUp() {
		if( !class_exists("Symfony\Component\EventDispatcher\EventDispatcher") ) {
			$this->fail('You must install dev dependencies to be able run tests!');
		}

		$this->dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
	}

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage Yes event triggered
	 */
	public function testAdapter() {
		$adapter = new SymfonyEventDispatcherAdapter($this->dispatcher);
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
