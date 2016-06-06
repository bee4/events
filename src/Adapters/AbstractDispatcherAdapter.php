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

/**
 * Bridge to the Symfony EventDispatcher implementation
 * @package BeeBot\Event\Adapters
 */
abstract class AbstractDispatcherAdapter implements DispatcherInterface
{
    /**
     * Adapted instance
     */
    protected $dispatcher;

    /**
     * @see DispatcherInterface::dispatch
     * @param string $name
     * @param EventInterface $event
     * @return EventInterface
     */
    public function dispatch($name, EventInterface $event)
    {
        $listeners = $this->get($name);
        foreach ($listeners as $listener) {
            call_user_func($listener, $event, $name, $this);
        }

        return $event;
    }

    /**
     * @see DispatcherInterface::add
     * @param string   $name
     * @param callable $listener
     * @param integer  $priority
     * @deprecated
     */
    public function add($name, callable $listener, $priority = 0)
    {
        return $this->on($name, $listener);
    }

    /**
     * @see DispatcherInterface::on
     * @param string $name
     * @param Callable $listener
     * @param int $priority
     * @return DispatcherInterface
     */
    abstract public function on($name, callable $listener);

    /**
     * @see DispatcherInterface::once
     * @param string $name
     * @param Callable $listener
     * @param int $priority
     * @return DispatcherInterface
     */
    public function once($name, callable $listener)
    {
        $once = function() use (&$once, $name, $listener) {
            $this->remove($name, $once);
            call_user_func_array($listener, func_get_args());
        };
        $this->on($name, $once);
    }

    /**
     * @see DispatcherInterface::remove
     * @param string $name
     * @param Callable $listener
     * @return DispatcherInterface
     */
    abstract public function remove($name, callable $listener);

    /**
     * @see DispatcherInterface::get
     * @param string $name
     * @return array
     */
    abstract public function get($name);
}
