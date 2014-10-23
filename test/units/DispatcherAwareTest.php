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

use Bee4\Events\DispatcherAwareTrait;
use Bee4\Events\DispatcherInterface;

/**
 * Check behaviour of the DispatcherAwareTrait
 * @package Bee4\Test\Events
 */
class DispatcherAwareTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Dispatcher instance
	 * @var DispatcherInterface
	 */
	protected $dispatcher;

	/**
	 * Dispatcher user
	 * @var DispatcherAwareTrait
	 */
	protected $aware;

	protected function setUp() {
		$this->dispatcher = $this->getMock('Bee4\Events\DispatcherInterface');
		$this->aware = $this->getMockForTrait('Bee4\Events\DispatcherAwareTrait');
	}

	public function testBehaviour() {
		$event = $this->getMock('Bee4\Events\EventInterface');

		$this->assertFalse($this->aware->dispatch('name', $event));
		$this->aware->setDispatcher($this->dispatcher);
		$this->assertTrue($this->aware->dispatch('name', $event));
	}
}
