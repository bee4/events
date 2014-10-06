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

namespace BeeBot\Event\Adapters;

use Bee4\Events\DispatcherInterface;
use Bee4\Events\EventInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Bridge to the Symfony EventDispatcher implementation
 * @package BeeBot\Event\Adapters
 */
class SymfonyEventDispatcherAdapter implements DispatcherInterface
{
    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @param EventDispatcher $dispatcher
     */
    public function __construct( EventDispatcher $dispatcher ) {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $name
     * @param EventInterface $event
     * @return EventInterface
     */
    public function dispatch($name, EventInterface $event)
    {
        $listeners = $this->dispatcher->getListeners($name);
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
    public function addListener($name, $listener, $priority = 0)
    {
        $this->dispatcher->addListener($name, $listener, $priority);
        return $this;
    }

    /**
     * Add a listener for the given event
     * @param string $name
     * @param Callable $listener
     * @return DispatcherInterface
     */
    public function removeListener($name, $listener)
    {
        $this->dispatcher->removeListener($name, $listener);
        return $this;
    }
} 