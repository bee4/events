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
 * Event dispatcher aware behaviour
 * Allow an object to know the current event dispatcher with Dependency injection
 * @package BeeBot\Event
 */
trait DispatcherAwareTrait
{
	/**
	 * The linked dispatcher instance
	 * @var DispatcherInterface
	 */
	private $dispatcher;

	/**
	 * Dependency injection
	 * @param DispatcherInterface $dispatcher
	 */
	public function setDispatcher(DispatcherInterface $dispatcher) {
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Access to the current dispatcher
	 * @return DispatcherInterface|null
	 */
	final public function getDispatcher() {
		return $this->dispatcher;
	}

	/**
	 * Check if a dispatcher has been injected or not
	 * @return boolean
	 */
	final public function hasDispatcher() {
		return $this->dispatcher !== null && $this->dispatcher instanceof DispatcherInterface;
	}

	/**
	 * Dispatch an event if the dispatcher is loaded
	 * @param string $name event name to dispatch
	 * @param EventInterface $event
	 * @return boolean
	 */
	final public function dispatch($name, EventInterface $event) {
		if( $this->hasDispatcher() ) {
			$this->getDispatcher()->dispatch($name, $event);
			return true;
		}
		return false;
	}
}