<?php

require_once './controllers/HomeController.php';
require_once './controllers/CareerController.php';
require_once './controllers/SubjectController.php';
require_once './controllers/UserController.php';
require_once 'Router.php';

//routes constants
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define("LOGIN", BASE_URL . "login");


$router = new Router();

//HOME ROUTE
$router->addRoute('', 'GET', 'HomeController', 'index');

$router->addRoute('404', 'GET', 'HomeController', 'showNotFoundPage');


//SESSION ROUTES


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
$router->addRoute('subjects/page/:PAGE_NUMBER', 'GET', 'SubjectController', 'index');
//view: subjects searcher page
$router->addRoute('subjects/searcher', 'GET', 'SubjectController', 'showSearcher');
//view: an specific subject
$router->addRoute('subjects/:ID', 'GET', 'SubjectController', 'show');
//view: edit form for a subject
$router->addRoute('subjects/:ID/edit', 'GET', 'SubjectController', 'edit');


//action: add a new subject
$router->addRoute('subjects/add', 'POST', 'SubjectController', 'add');
//action: update a subject
$router->addRoute('subjects/:ID/update', 'POST', 'SubjectController', 'update');
//action: delete a subject
$router->addRoute('subjects/:ID/delete', 'GET', 'SubjectController', 'delete');
//action: subjects searchAction
$router->addRoute('subjects/search', 'POST', 'SubjectController', 'search');



//USERS ROUTES
//view: form to create a new user
$router->addRoute('signup', 'GET', 'UserController', 'index');
//view: form to sign in
$router->addRoute('signin', 'GET', 'UserController', 'showSignIn');
//view: all users
$router->addRoute('users', 'GET', 'UserController', 'show');
//view: edit form for a user
$router->addRoute('users/:ID/edit', 'GET', 'UserController', 'edit');
//action: add a new user
$router->addRoute('users/add', 'POST', 'UserController', 'add');
//action: update a user
$router->addRoute('users/:ID/update', 'POST', 'UserController', 'update');
//action: delete a user
$router->addRoute('users/:ID/delete', 'GET', 'UserController', 'delete');
//action: sign out
$router->addRoute('signout', 'GET', 'UserController', 'signOut');
//action: verify user
$router->addRoute('verifyUser', 'POST', 'UserController', 'verifyUser');


$router->setDefaultRoute("HomeController", "showNotFoundPage");

$router->route($_GET['action'], $_SERVER['REQUEST_METHOD']);

