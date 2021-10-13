<?php
require_once 'controller/Controller.php';
require_once 'controller/AuthController.php';

require_once 'controller/AuthController.php';

require_once 'controller/CareerListController.php';
require_once 'controller/SubjectsListController.php';


define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define("LOGIN", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]) . 'login');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '/home';
}
$params = explode('/', $action);

$controller = new Controller();
$authController = new AuthController();
$subjectsController = new SubjectsListController();
$careersController = new CareersListController();


switch ($params[1]) {
    case 'home':
        $controller->Home();
        break;
    case 'login':
        $controller->login();
        break;
    case 'validateUser':
        $authController->verifyUser();
        break;
    case 'subjects':
        if ($params[2]!=null && $params[2]=='add') {
            $subjectsController->add($_POST);
            break;
        }
        if ($params[2] != null && $params[2] != '') {
            if ($params[3]!=null&&$params[3]=='delete') {
                $subjectsController->delete($params[2]);
                break;    
            }
            if ($params[4]!=null&&$params[4]=='send') {
                $subjectsController->sendEdit($params[2],$_POST);
                break;
            }
            if ($params[3]!=null && $params[3]=='edit') {
                $subjectsController->edit($params[2]);   
                break;
            }
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
        $careersController->listCareers();
        break;
    default:
        echo ('404 Page not found');
        break;
}
