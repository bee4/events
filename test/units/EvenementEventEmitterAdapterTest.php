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
class EvenementEventEmitterAdapterTest extends AbstractAdapterTest {
	protected function setUp() {
		if( !class_exists("Evenement\EventEmitter") ) {
			$this->markTestSkipped('You must install dev dependencies to be able run tests!');
		}

		$this->adapter = new EvenementEventEmitterAdapter(
			new \Evenement\EventEmitter()
		);
	}
}
