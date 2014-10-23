<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2014
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package Bee4\Events
 */

namespace Bee4\Events;

/**
 * Event dispatcher interface, define how to dispatch an event
 * @package Bee4\Events
 */
interface DispatcherInterface
{
	/**
	 * @param string $name
	 * @param EventInterface $event
	 * @return EventInterface
	 */
	public function dispatch($name, EventInterface $event);

	/**
	 * Add a listener for the given event
	 * @param string $name
	 * @param Callable $listener
	 * @param int $priority
	 * @return DispatcherInterface
	 */
	public function add($name, $listener, $priority = 0);

	/**
	 * Remove a listener for the given event name
	 * @param string $name
	 * @param Callable $listener
	 * @return DispatcherInterface
	 */
	public function remove($name, $listener);

	/**
	 * Retrieve the listeners for a given event name
	 * @param string $name
	 * @return array
	 */
	public function get($name);
}