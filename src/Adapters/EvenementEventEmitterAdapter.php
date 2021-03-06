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

use Evenement\EventEmitter;

/**
 * Bridge to the Événement EventEmmiter implementation
 * @see https://github.com/igorw/evenement
 * @package BeeBot\Event\Adapters
 */
class EvenementEventEmitterAdapter extends AbstractDispatcherAdapter
{
    /**
     * Adapted dispatcher
     * @var Evenement\EventEmitter
     */
    protected $dispatcher;

    /**
     * @param Evenement\EventEmitter $dispatcher
     */
    public function __construct(EventEmitter $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @see AbstractDispatcherAdapter::on
     */
    public function on($name, callable $listener)
    {
        $this->dispatcher->on($name, $listener);
        return $this;
    }

    /**
     * @see AbstractDispatcherAdapter::remove
     */
    public function remove($name, callable $listener)
    {
        $this->dispatcher->removeListener($name, $listener);
        return $this;
    }

    /**
     * @see AbstractDispatcherAdapter::get
     */
    public function get($name)
    {
        return $this->dispatcher->listeners($name);
    }
}
