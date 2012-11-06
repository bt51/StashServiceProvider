<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Bt51\Silex\Provider\StashServiceProvider\StashServiceProvider;

$app = new Application();

$app->register(new StashServiceProvider(),
               array('stash.handler.class' => 'FileSystem',
                     'stash.handler.options' => array('path' => __DIR__ . '/cache')));

$app->get('/', function () use ($app) {
    $key = md5('fixture');
    $cache = $app['stash'];
    $cache->setupKey($key);
    $content = $cache->get();

    if ($cache->isMiss()) {
        $content = file_get_contents(__DIR__ . '/fixture');
        $cache->lock();
        $cache->set($content);
    }
    
    return new Response($content, 200, array('Content-Type' => 'text/plain'));
});
