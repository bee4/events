<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2016
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 */

namespace Bee4\Events\Adapters;

use League\Event\Emitter;
use League\Event\CallbackListener;

/**
 * Bridge to the PHP League Event implementation
 * @see http://event.thephpleague.com/2.0/
 */
class LeagueEventAdapter extends AbstractDispatcherAdapter
{
    /**
     * Adapted emitter
     * @var Emitter
     */
    protected $emitter;

    /**
     * @param Emitter $emitter
     */
    public function __construct(Emitter $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @see AbstractDispatcherAdapter::on
     */
    public function on($name, callable $listener, $priority = 0)
    {
        $this->emitter->addListener($name, $listener, $priority);
        return $this;
    }

    /**
     * @see AbstractDispatcherAdapter::remove
     */
    public function remove($name, callable $listener)
    {
        $this->emitter->removeListener($name, $listener);
        return $this;
    }

    /**
     * @see AbstractDispatcherAdapter::get
     */
    public function get($name)
    {
        return array_map(
            function (CallbackListener $listener) {
                return $listener->getCallback();
            },
            $this->emitter->getListeners($name)
        );

    }
}
