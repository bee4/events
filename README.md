Bee4 / Events v1.0.2
====================

[![Build Status](https://img.shields.io/travis/bee4/events.svg?style=flat-square)](https://travis-ci.org/bee4/events)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/bee4/events.svg?style=flat-square)](https://scrutinizer-ci.com/g/bee4/events/?branch=develop)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/bee4/events.svg?style=flat-square)](https://scrutinizer-ci.com/g/bee4/events/)
[![SensiolabInsight](https://img.shields.io/sensiolabs/i/f06ff1ba-40a5-483b-88ce-c37b10177b2c.svg?style=flat-square)](https://insight.sensiolabs.com/projects/f06ff1ba-40a5-483b-88ce-c37b10177b2c)


[![License](https://img.shields.io/packagist/l/bee4/events.svg?style=flat-square)](https://packagist.org/packages/bee4/events)

The main goal of this code is to allow using Event Dispatcher pattern with different popular implementations :

* [Symfony 2 Event Dispatcher](http://symfony.com/doc/current/components/event_dispatcher/introduction.html) component
* [Événment Event Emittter](https://github.com/igorw/evenement) component
* more to come [Zend Framework 2 Event Manager](https://github.com/zendframework/Component_ZendEventManager)...

This library does not intend to provide the whole possibilities of each adapters but a standard couple of interface which allow to do not depend from one vendor. This way, you can use your preferred event system with one of the `bee4/events` user.


Installing
----------
[![Latest Stable Version](https://img.shields.io/packagist/v/bee4/events.svg?style=flat-square)](https://packagist.org/packages/bee4/events)
[![Total Downloads](https://img.shields.io/packagist/dm/bee4/events.svg?style=flat-square)](https://packagist.org/packages/bee4/events)

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

###DispatcherAwareInterface
Define how an object can rely to a dispatcher to handle events

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
