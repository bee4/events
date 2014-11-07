Bee4 / Events
=============

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bee4/events/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/bee4/events/?branch=develop)
[![Latest Stable Version](https://poser.pugx.org/bee4/events/v/stable.png)](https://packagist.org/packages/bee4/events)
[![Total Downloads](https://poser.pugx.org/bee4/events/downloads.png)](https://packagist.org/packages/bee4/events)
[![Latest Unstable Version](https://poser.pugx.org/bee4/events/v/unstable.png)](https://packagist.org/packages/bee4/events)
[![License](https://poser.pugx.org/bee4/events/license.png)](https://packagist.org/packages/bee4/events)

The main goal of this code is to allow using Event Dispatcher pattern with different popular implementations :

* [Symfony 2 Event Dispatcher](http://symfony.com/doc/current/components/event_dispatcher/introduction.html) component
* more to come [Événement](https://github.com/igorw/evenement), [Zend Framework 2 Event Manager](https://github.com/zendframework/Component_ZendEventManager)...

This library does not intend to provide the whole possibilities of each adapters but a standard couple of interface which allow to do not depend from one vendor. This way, you can use your preferred event system with one of the `bee4/events` user.


Installing
----------
This project can be installed using Composer. Add the following to your composer.json:

```JSON
{
    "require": {
        "bee4/events": "~1.0"
    }
}
```

or run this command:

```Shell
composer require bee4/events:~1.0
```
    
Event System
------------
### DispatcherInterface
Define how an object must trigger an event. It contains 4 methods :

* `dispatch` to trigger an EventInterface instance
* `add` to attach a listener with priority
* `remove` to remove a given listener
* `get` to retrieve all listeners attached to one event name

### EventInterface
Define an event object which can be triggered. There is no default behaviour for this kinf of object because an event can be really specific.

Adapters
--------
I hope you don't want to create your own dispatcher because there are some cool stuff overhere. There are adapters classes located in the `Bee4\Events\Adapters` namespace which can be used :

```PHP
<?php
$vendor = new \Symfony\Component\EventDispatcher\EventDispatcher;
$adapter = new \Bee4\Events\Adapters\SymfonyEventDispatcherAdapter($vendor);

$adapter->add('name', function(EventInterface $event) {
	echo "I have been triggered: ".PHP_EOL.print_r($event, true);
});

//EventImplementation must be defined in your project to suit your needs
$adapter->dispatch('name', new EventImplementation);
```