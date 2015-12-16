<?php

// Set the app_path to the root dir
define('APP_PATH', realpath('../') . '/');

// Auto load the classes
require_once APP_PATH . 'vendor/autoload.php';

// Auto load the dependency injector
require_once APP_PATH . 'app/config/services.php';

// Start the app
$app = new \Slim\App($di);

// Homepage
$app->get('/', function ($request, $response) {

    $response->getBody()->write('Hello World!');

    return $response;

});

// Handle the routes
$app->run();
