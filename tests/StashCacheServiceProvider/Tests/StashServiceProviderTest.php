<?php

/*
 * This file is part of StashServiceProvider
 *
 * (c) Ben Tollakson <ben.tollakson@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StashServiceProvider\Tests;

use Silex\Application;
use Bt51\Silex\Provider\StashServiceProvider\StashServiceProvider;

class StashServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('Stash\\Cache')) {
            $this->markTestSkipped('Stash is not installed');
        }
    }
    
    public function testSilexStash()
    {
        $app = new Application();
        
        $app->register(new StashServiceProvider());
        
        $this->assertInstanceOf('\\Stash\\Cache', $app['stash']);
    }
    
    public function testStashGet()
    {
        $app = new Application();
        
        $app->register(new StashServiceProvider());
        
        $cache = $app['stash'];
        
        $key = md5(mt_rand());
        $content = md5(uniqid(mt_rand()));
        
        $cache->setupKey(md5(mt_rand()));
        $content = $cache->get();

        if ($cache->isMiss()) {
            $cache->set($content);
        }
        
        $this->assertEquals($content, $cache->get($key));
    }
}
