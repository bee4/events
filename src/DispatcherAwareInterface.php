<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2015
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package Bee4\Events
 */

namespace Bee4\Events;

/**
 * Event dispatcher aware behaviour
 * Allow an object to know the current event dispatcher with injection
 *
 * @package Bee4\Event
 */
interface DispatcherAwareInterface
{
	/**
	 * Dependency injection
	 *
	 * @param DispatcherInterface $dispatcher
	 */
	public function setDispatcher(DispatcherInterface $dispatcher);

	/**
	 * Access to the current dispatcher
	 *
	 * @return DispatcherInterface|null
	 */
	public function getDispatcher();

	/**
	 * Check if a dispatcher has been injected or not
	 *
	 * @return boolean
	 */
	public function hasDispatcher();

	/**
	 * Dispatch an event if the dispatcher is loaded
	 *
	 * @param string $name event name to dispatch
	 * @param EventInterface $event
	 * @return boolean
	 */
	public function dispatch($name, EventInterface $event);
}
