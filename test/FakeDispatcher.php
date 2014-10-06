<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2014
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package Bee4\Test\Events
 */

namespace Bee4\Test\Events;

use Bee4\Events\DispatcherInterface;
use Bee4\Events\EventInterface;

/**
 * A basic dispatcher implementation that can be used for testing purpose
 * @package Bee4\Test\Events
 */
class FakeDispatcher implements DispatcherInterface
{
    /**
     * Listener collection
     * @var array
     */
    protected $listeners = [];

    /**
     * @param string $name
     * @param EventInterface $event
     * @return EventInterface
     */
    public function dispatch($name, EventInterface $event) {
        if( isset($this->listeners[$name]) ) {
            foreach( $this->listeners[$name] as $priority ) {
                foreach( $priority as $callable ) {
                    call_user_func($callable, $event, $name, $this);
                }
            }
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
    public function addListener( $name, $listener, $priority = 0 ) {
        $this->listeners[$name][$priority][] = $listener;
        sort($this->listeners[$name]);
        return $this;
    }

    /**
     * Add a listener for the given event
     * @param string $name
     * @return DispatcherInterface
     */
    public function getListeners($name = null)
    {
        if( $name === null ) {
            return $this->listeners;
        } elseif( $this->hasListeners($name)) {
            return $this->listeners[$name];
        } else {
            return [];
        }
    }

    /**
     * Add a listener for the given event
     * @param string $name
     * @return DispatcherInterface
     */
    public function hasListeners($name = null)
    {
        return isset($this->listeners[$name]);
    }

    /**
     * Add a listener for the given event
     * @param string $name
     * @param Callable $listener
     * @return DispatcherInterface
     */
    public function removeListener($name, $listener)
    {
        if( $this->hasListeners($name) ) {
            foreach ($this->listeners[$name] as $priority => $listeners ) {
                if (false !== ($key = array_search($listener, $listeners, true))) {
                    unset($this->listeners[$name][$priority][$key]);
                }
            }
        }
    }


} 