<?php
require_once 'controller/SessionController.php';
require_once 'controller/CareerController.php';
require_once 'controller/SubjectController.php';
require_once 'controller/HomeController.php';


$sessionController = new SessionController();
$subjectsController = new SubjectController();
$careersController = new CareerController();
$homeController = new HomeController();


define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define("LOGIN", BASE_URL . "login");



if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '/home';
}

$params = explode('/', $action);

switch ($params[1]) {
    case 'home':
        $homeController->index();
        break;
    case 'login':
        $sessionController->index();
        break;
    case 'logout':
        $sessionController->logout();
        break;
    case 'verifyUser':
        $sessionController->verifyUser();
        break;
    case 'subjects':
        if ($params[2] != null && $params[2] != '') {
            $subjectId = $params[2];
            $subjectsController->show($subjectId);
            break;
        }
        $subjectsController->listSubjects();
        break;
    case 'careers':
        if ($params[2] != null && $params[2] != '') {
            $careerId = $params[2];
            $careersController->show($careerId);
            break;
        }
        $careersController->index();
        break;
    default:
        echo ('404 Page not found');
        break;
}
