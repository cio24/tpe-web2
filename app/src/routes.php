<?php

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

//SUBJECTS ROUTES

//view: all subjects and a form for create a new one (admins only)
$router->addRoute('subjects', 'GET', 'SubjectsController', 'index'); 
//view: an specific subject
$router->addRoute('subjects/:id', 'GET', 'SubjectsController', 'show'); 
//view: edit form for a subject
$router->addRoute('subjects/:id/edit', 'GET', 'SubjectsController', 'edit'); 

//action: add a new subject
$router->addRoute('subjects/POST', 'POST', 'SubjectsController', 'add');
//action: confirm the edition of a subject
$router->addRoute('subjects/update', 'UPDATE', 'SubjectsController', 'update');
//action: 
$router->addRoute('subjects/:id', 'UPDATE', 'SubjectsController', 'update');
$router->addRoute('subjects', 'GET', 'SubjectsController', 'delete');
