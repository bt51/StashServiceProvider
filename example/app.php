<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Bt51\Silex\Provider\StashServiceProvider\StashServiceProvider;

$app = new Application();

$app->register(new StashServiceProvider(),
               array('stash.driver.class' => 'FileSystem',
                     'stash.driver.options' => array('path' => __DIR__ . '/cache')));

$app->get('/', function () use ($app) {
    $key = md5('fixture');
    $pool = $app['stash'];
    $stashItem = $pool->getItem($key);
    
    $content = $stashItem->get();

    if ($stashItem->isMiss()) {
        $content = file_get_contents(__DIR__ . '/fixture');
        $stashItem->set($content);
    }
    
    return new Response($content, 200, array('Content-Type' => 'text/plain'));
});
