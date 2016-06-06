<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2014
 * @author  Stephane HULARD <s.hulard@chstudio.fr>
 */

namespace Bee4\Events\Test\Units\Adapters;

/**
 * Check behaviour of an adapter
 */
abstract class AbstractAdapterTest extends \atoum
{

    protected $adapter;

    public function testAdapter()
    {
        $this
            ->given(
                $handler = function () {
                    echo "Youpi!";
                },
                $event = new \Mock\Bee4\Events\EventInterface
            )
            ->when($this->adapter->on('name', $handler))
            ->output(function () use ($event) {
                $this->adapter->dispatch('name', $event);
            })
                ->isEqualTo("Youpi!");
    }

    public function testOn()
    {
        $this
            ->given($handler = function () {
                echo "Youpi!";
            })
            ->then
                ->array($this->adapter->get('name'))
                    ->hasSize(0)
            ->when($this->adapter->on('name', $handler))
            ->then
                ->array($this->adapter->get('name'))
                    ->hasSize(1);
    }


    public function testRemove()
    {
        $this
            ->given(
                $handler = function () {
                    echo "Youpi!";
                },
                $this->adapter->on('name', $handler)
            )
            ->then
                ->array($this->adapter->get('name'))
                    ->hasSize(1)
            ->when($this->adapter->remove('name', $handler))
            ->then
                ->array($this->adapter->get('name'))
                    ->hasSize(0);
    }
}
