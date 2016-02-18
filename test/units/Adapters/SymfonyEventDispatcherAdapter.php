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

use Bee4\Events\Adapters\SymfonyEventDispatcherAdapter as SUT;

/**
 * Check behaviour SF2 EventDispatcher adapter
 */
class SymfonyEventDispatcherAdapter extends AbstractAdapterTest
{
    public function beforeTestMethod($method)
    {
        $this->adapter = new SUT(
            new \Symfony\Component\EventDispatcher\EventDispatcher()
        );
    }
}
