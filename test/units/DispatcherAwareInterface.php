<?php
/**
 * This file is part of the bee4/events package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Bee4 2016
 * @author  Stephane HULARD <s.hulard@chstudio.fr>
 */

namespace Bee4\Events\Test\Units;

/**
 * Check behaviour of the DispatcherAwareInterface
 */
class DispatcherAwareInterface extends \atoum
{
    public function testInterface()
    {
        $this
            ->given($event = new \Mock\Bee4\Events\DispatcherAwareInterface)
            ->then
                ->object($event)
                    ->isInstanceOf('Bee4\Events\DispatcherAwareInterface');
    }
}
