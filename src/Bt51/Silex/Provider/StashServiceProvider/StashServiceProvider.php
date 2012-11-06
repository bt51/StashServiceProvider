<?php

/*
 * This file is part of StashServiceProvider
 *
 * (c) Ben Tollakson <ben.tollakson@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bt51\Silex\Provider\StashServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Stash\Cache;

class StashServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (! isset($app['stash.handler.class'])) {
            $app['stash.handler.class'] = 'Ephemeral';
        }

        $app['stash.handler'] = $app->share(function ($app) {
            $options = (isset($app['stash.handler.options']) ? $app['stash.handler.options'] : array());
            $class = sprintf('\\Stash\\Handler\\%s', $app['stash.handler.class']);
            $handler = new \ReflectionClass($class);
            return $handler->newInstanceArgs(array($options));
        });
        
        $app['stash'] = $app->share(function ($app) {
            return new Cache($app['stash.handler']);
        });
    }
    
    public function boot(Application $app)
    {
        
    }
}
