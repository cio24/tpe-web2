<?php

// phpinfo();



require_once 'Router.php';
require_once './controller/HomeController.php';
require_once './controller/SessionController.php';
require_once './controller/CareerController.php';
require_once './controller/SubjectController.php';

//routes constants
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define("LOGIN", BASE_URL . "login");


$router = new Router();

//HOME ROUTE

$router->addRoute('home', 'GET', 'HomeController', 'index');

//SESSION ROUTES

//view: login form
$router->addRoute('login', 'GET', 'SessionController', 'index');
//action: logout
$router->addRoute('logout', 'GET', 'SessionController', 'logout');
//action: user verification
$router->addRoute('verifyUser', 'POST', 'SessionController', 'verifyUser');


//SUBJECTS ROUTES

//view: all subjects and a form for create a new one (form for admins only)
$router->addRoute('subjects', 'GET', 'SubjectController', 'index'); 
//view: an specific subject
$router->addRoute('subjects/:id', 'GET', 'SubjectController', 'show'); 
//view: edit form for a subject (admins only)
$router->addRoute('subjects/:id/edit', 'GET', 'SubjectController', 'edit'); 

//action: add a new subject (admins only)
$router->addRoute('subjects', 'POST', 'SubjectController', 'add');
//action: confirm the edition of a subject (admins only)
$router->addRoute('subjects/:id/update', 'POST', 'SubjectController', 'update');
//action: delete a subject (admins only)
$router->addRoute('subjects/:id/delete', 'GET', 'SubjectController', 'delete');


//CAREERS ROOUTES

//view: all careers and a form for create a new one (form for admins only)
$router->addRoute('careers', 'GET', 'CareerController', 'index');
//view: an specific career
$router->addRoute('careers/:id', 'GET', 'CareerController', 'show');
//view: edit form for a career (admins only)
$router->addRoute('careers/:id/edit', 'GET', 'CareerController', 'edit');

//action: add a new career (admins only)
$router->addRoute('careers', 'POST', 'CareerController', 'add');
//action: confirm the edition of a career (admins only)
$router->addRoute('careers/:id/update', 'POST', 'CareerController', 'update');
//action: delete a career (admins only)
$router->addRoute('careers/:id/delete', 'GET', 'CareerController', 'delete');


$router->setDefaultRoute('HomeController','index');

$router->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
