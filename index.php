<?php

require_once __DIR__ . '/core/components/Router.php';

use Core\Components\Router;

$router = new Router();
$router->dispatch();
