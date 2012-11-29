StashServiceProvider
================

The StashServiceProvider provides the "tedivm/stash" library for silex.
Read more on stash here: [stash.tedivm.com](http://stash.tedivm.com)
*Note:* The StashServiceProvider uses master branch of Stash.
Stash is under active development.

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

* **stash.driver.options**: An array of options to be passed to the driver's constructor
* **stash.driver.class**: The cache class adapter to use

Services
--------

* **stash**: Instance of Stash\Pool
* **stash.handler**: Instance of Stash\Handler\{stash.driver.class}

Registering
----------

See the *example/* directory to see how to register the service

License
-------

MIT
