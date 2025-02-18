<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();

// Ajout des fournisseurs de services
$app->register(new DoctrineServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

//Ajout des repository
$app['repository.ligne'] = function ($app) {
    return new App\Lignes\Repository\LigneRepository($app['db']);
};

$app['repository.stop'] = function ($app) {
    return new App\Stops\Repository\StopRepository($app['db']);
};