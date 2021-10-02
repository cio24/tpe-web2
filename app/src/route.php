<?php
echo 'aca en el route';
require_once 'controller/Controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

$controller = new Controller();

switch ($params[0]) {
    case 'home':
        var_dump($controller);
        $controller->Home();
        break;

    default:
        echo ('404 Page not found');
        break;
}
