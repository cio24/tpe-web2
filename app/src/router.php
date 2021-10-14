<?php
require_once 'controller/SessionController.php';
require_once 'controller/CareerController.php';
require_once 'controller/SubjectController.php';
require_once 'controller/HomeController.php';

//controllers
$sessionController = new SessionController();
$subjectController = new SubjectController();
$careersController = new CareerController();
$homeController = new HomeController();

//routes constants
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define("LOGIN", BASE_URL . "login");


//handling params
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

    case 'verifyUser':
        $sessionController->verifyUser();
        break;

    case 'logout':
        $sessionController->logout();
        break;

    case 'subjects':
        //actions
        if ($params[2] != null && $params[2] == 'add') {
            $subjectController->add($_POST);
            break;
        }
        if ($params[2] != null && $params[2] != '') {
            if ($params[3] != null && $params[3] == 'delete') {
                $subjectsController->delete($params[2]);
                break;
            }
            if ($params[4] != null && $params[4] == 'send') {
                $subjectsController->sendEdit($params[2], $_POST);
                break;
            }
            if ($params[3] != null && $params[3] == 'edit') {
                $subjectsController->edit($params[2]);
                break;
            }
            $subjectId = $params[2];
            $subjectController->show($subjectId);
            break;
        }
        $subjectController->index();
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
}
