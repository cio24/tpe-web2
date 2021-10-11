<?php
require_once 'controller/Controller.php';
require_once 'controller/SubjectsListController.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '/home';
}

$params = explode('/', $action);

$controller = new Controller();
$subjectsController = new SubjectsListController();

switch ($params[1]) {
    case 'home':
        $controller->Home();
        break;
    case 'subjects':
        $subjectsController->listSubjects();
        break;
    default:
        echo ('404 Page not found');
        break;
}
