<?php

/*
 * This file is part of StashServiceProvider
 *
 * (c) Ben Tollakson <btollakson.os@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bt51\Silex\Provider\StashServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Stash\Pool;

class StashServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (! isset($app['stash.driver.class'])) {
            $app['stash.driver.class'] = 'Ephemeral';
        }

        $app['stash.driver'] = $app->share(function ($app) {
            $options = (isset($app['stash.driver.options']) ? $app['stash.driver.options'] : array());
            $class = sprintf('\\Stash\\Driver\\%s', $app['stash.driver.class']);
            $driver  = new $class;
            $driver->setOptions($options);
            return $driver;            
        });
        
        $app['stash'] = $app->share(function ($app) {
            return new Pool($app['stash.driver']);
        });
    }
    
    public function boot(Application $app)
    {
        
    }
}
