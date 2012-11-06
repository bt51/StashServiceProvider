StashServiceProvider
================

The StashServiceProvider provides the "tedivm/stash" library for silex.
Read more on stash here: [stash.tedivm.com](http://stash.tedivm.com)

Installation
------------

Create a composer.json in your project

    {
        "require": {
            "bt51/stash-serviceprovider": "dev-master"
        }
    }

Read more on composer here: http://getcomposer.org

Parameters
----------

* **stash.handler.options**: An array of options to be passed to the parser's constructor
* **stash.handler.class**: The cache class adapter to use

Services
--------

* **stash**: Instance of Stash\Cache
* **stash.handler**: Instance of Stash\Handler\{stash.handler.class}

Registering
----------

See the *example/* directory to see how to register the service

License
-------

MIT
