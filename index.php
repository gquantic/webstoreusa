<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

##############
##############
##############

# Autoload
require_once 'vendor/autoload.php';

# Include router
$router = new \Engine\App\Router();

$router->get('/', function () {
    return include 'resources/views/auth/auth.php';
});

$router->init();