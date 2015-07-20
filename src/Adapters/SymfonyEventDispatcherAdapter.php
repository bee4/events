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
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Bridge to the Symfony EventDispatcher implementation
 * @see https://github.com/symfony/EventDispatcher
 * @package BeeBot\Event\Adapters
 */
class SymfonyEventDispatcherAdapter extends AbstractDispatcherAdapter
{
	/**
	 * Adapted dispatcher
	 * @var Symfony\Component\EventDispatcher\EventDispatcher
	 */
	protected $dispatcher;

	/**
	 * @param Symfony\Component\EventDispatcher\EventDispatcher $dispatcher
	 */
	public function __construct( EventDispatcher $dispatcher ) {
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @see AbstractDispatcherAdapter::add
	 */
	public function add($name, Callable $listener, $priority = 0) {
		$this->dispatcher->addListener($name, $listener, $priority);
		return $this;
	}

	/**
	 * @see AbstractDispatcherAdapter::remove
	 */
	public function remove($name, Callable $listener) {
		$this->dispatcher->removeListener($name, $listener);
		return $this;
	}

	/**
	 * @see AbstractDispatcherAdapter::get
	 */
	public function get($name) {
		return $this->dispatcher->getListeners($name);
	}
}
