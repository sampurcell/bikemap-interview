<?php

use Slim\App;
use Slim\Container;

define('DOCROOT', dirname(__DIR__));

require DOCROOT . '/vendor/autoload.php';

$container = new Container();
$container['settings']['determineRouteBeforeAppMiddleware'] = false;
$container['settings']['displayErrorDetails'] = true;
$container['settings']['db'] = [
    'driver' => 'mysql',
    'host' => 'global-mysql',
    'database' => 'bikemap_backend',
    'username' => 'root',
    'password' => 'P@ssw0rd',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container['twig'] = function ($container) {
    return new Twig_Environment(
        new Twig_Loader_Filesystem(DOCROOT . '/resources/html')
    );
};

$app = new App($container);

require_once DOCROOT . '/routes.php';

$app->run();
