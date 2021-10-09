<?php
require_once 'controller/Controller.php';
require_once 'controller/SubjectsListController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);
var_dump($params);
var_dump($_GET);
$controller = new Controller();
$subjectsController = new SubjectsListController();

switch ($params[0]) {
    case 'home':
        $controller->Home();
        break;
    case 'subjects':
        echo 'materias';
        $subjectsController->listSubjects();
        break;
    default:
        echo ('404 Page not found');
        break;
}
