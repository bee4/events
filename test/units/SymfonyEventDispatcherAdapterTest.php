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
class SymfonyEventDispatcherAdapterTest extends AbstractAdapterTest {
	protected function setUp() {
		if( !class_exists("Symfony\Component\EventDispatcher\EventDispatcher") ) {
			$this->markTestSkipped('You must install dev dependencies to be able run tests!');
		}

		$this->adapter = new SymfonyEventDispatcherAdapter(
			new \Symfony\Component\EventDispatcher\EventDispatcher()
		);
	}
}
