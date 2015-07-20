<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2014
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package Bee4\Events\Adapters
 */

namespace Bee4\Events\Adapters;

use Bee4\Events\DispatcherInterface;
use Bee4\Events\EventInterface;
use Evenement\EventEmitter;

/**
 * Bridge to the Événement EventEmmiter implementation
 * @see https://github.com/igorw/evenement
 * @package BeeBot\Event\Adapters
 */
class EvenementEventEmitterAdapter implements DispatcherInterface
{
	/**
	 * Adapted instance
	 * @var EventEmmitter
	 */
	protected $dispatcher;

	/**
	 * @param EventEmitter $dispatcher
	 */
	public function __construct( EventEmitter $dispatcher ) {
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @param string $name
	 * @param EventInterface $event
	 * @return EventInterface
	 */
	public function dispatch($name, EventInterface $event)
	{
		$listeners = $this->dispatcher->listeners($name);
		foreach( $listeners as $listener ) {
			call_user_func($listener, $event, $name, $this);
		}

		return $event;
	}

	/**
	 * Add a listener for the given event
	 * @param string $name
	 * @param Callable $listener
	 * @param int $priority
	 * @return DispatcherInterface
	 */
	public function add($name, $listener, $priority = 0)
	{
		$this->dispatcher->on($name, $listener);
		return $this;
	}

	/**
	 * Add a listener for the given event
	 * @param string $name
	 * @param Callable $listener
	 * @return DispatcherInterface
	 */
	public function remove($name, $listener)
	{
		$this->dispatcher->removeListener($name, $listener);
		return $this;
	}

	/**
	 * Retrieve the listeners for a given event name
	 * @param string $name
	 * @return array
	 */
	public function get($name)
	{
		return $this->dispatcher->listeners($name);
	}
}
