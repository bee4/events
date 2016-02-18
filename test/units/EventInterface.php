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

use Bee4\Events\EventInterface as SUT;

/**
 * Check behaviour of the EventInterface
 */
class EventInterface extends \atoum
{
    public function testInterface()
    {
        $this
            ->given($event = new \Mock\Bee4\Events\EventInterface)
            ->then
                ->object($event)
                    ->isInstanceOf('Bee4\Events\EventInterface');
    }
}
