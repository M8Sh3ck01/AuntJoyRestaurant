<?php

require_once __DIR__ . '/core/db/DatabaseConfig.php';
require_once __DIR__ . '/core/db/DB.php';
require_once __DIR__ . '/core/components/Session.php';
require_once __DIR__ . '/core/components/Controller.php';
require_once __DIR__ . '/core/components/Router.php';

use Core\Components\Router;

$router = new Router();
$router->dispatch();
