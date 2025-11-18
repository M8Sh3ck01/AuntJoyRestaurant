<?php

namespace Core\Components;

use Core\Db\DB;

class Router
{
    public function dispatch(): void
    {
        // Ensure DB connection (will throw/die on failure)
        DB::getConnection();

        // Route format: ?r=module/controller/action
        $route = $_GET['r'] ?? 'customer/home/index';
        $parts = explode('/', trim($route, '/'));

        // Ensure we have module, controller, action
        $module = $parts[0] ?? 'customer';
        $controller = $parts[1] ?? 'home';
        $action = $parts[2] ?? 'index';

        $module = strtolower($module);
        $controller = strtolower($controller);
        $action = strtolower($action);

        // Build controller class and file path
        $moduleNamespace = ucfirst($module);               // e.g. 'Customer'
        $controllerClass = ucfirst($controller) . 'Controller'; // e.g. 'HomeController'
        $actionMethod = 'action' . ucfirst($action);           // e.g. 'actionIndex'

        $controllerFile = __DIR__ . '/../../' . $module . '/controllers/' . $controllerClass . '.php';

        // For this project, keep things simple:
        // if something is missing, just stop with a basic message.
        if (!is_file($controllerFile)) {
            die('Controller file not found: ' . $controllerFile);
        }

        require_once $controllerFile;

        $fqcn = $moduleNamespace . '\\Controllers\\' . $controllerClass;
        if (!class_exists($fqcn)) {
            die('Controller class not found: ' . $fqcn);
        }

        $controllerInstance = new $fqcn();
        if (!method_exists($controllerInstance, $actionMethod)) {
            die('Action not found: ' . $actionMethod);
        }

        $controllerInstance->{$actionMethod}();
    }
}
