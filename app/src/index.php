<?php

require_once './controller/HomeController.php';
require_once './controller/SessionController.php';
require_once './controller/CareerController.php';
require_once './controller/SubjectController.php';
require_once 'Router.php';

//routes constants
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define("LOGIN", BASE_URL . "login");


$router = new Router();

//HOME ROUTE
$router->addRoute('home', 'GET', 'HomeController', 'index');

//SESSION ROUTES
$router->addRoute('login', 'GET', 'SessionController', 'index');
$router->addRoute('logout', 'GET', 'SessionController', 'logout');
$router->addRoute('verifyUser', 'POST', 'SessionController', 'verifyUser');

//CAREERS ROUTES

//view: all careers and a form for create a new one (admins only)
$router->addRoute('careers', 'GET', 'CareerController', 'index');
//view: an specific career
$router->addRoute('careers/:ID', 'GET', 'CareerController', 'show');
//view: edit form for a career
$router->addRoute('careers/:ID/edit', 'GET', 'CareerController', 'edit');

//action: add a new career
$router->addRoute('careers/add', 'POST', 'CareerController', 'add');
//action: update a career
$router->addRoute('careers/:ID/update', 'POST', 'CareerController', 'update');
//action: delete a career
$router->addRoute('careers/:ID/delete', 'GET', 'CareerController', 'delete');



//SUBJECTS ROUTES

//view: all subjects and a form for create a new one (admins only)
$router->addRoute('subjects', 'GET', 'SubjectController', 'index');
//view: an specific subject
$router->addRoute('subjects/:ID', 'GET', 'SubjectController', 'show');
//view: edit form for a subject
$router->addRoute('subjects/:ID/edit', 'GET', 'SubjectController', 'edit');

//action: add a new subject
$router->addRoute('subjects/POST', 'POST', 'SubjectController', 'add');
//action: update a subject
$router->addRoute('subjects/update', 'POST', 'SubjectController', 'update');
//action: delete a subject
$router->addRoute('subjects', 'GET', 'SubjectController', 'delete');


$router->setDefaultRoute("HomeController", "index");

$router->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
