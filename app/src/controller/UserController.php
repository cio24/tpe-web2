<?php

require_once 'model/UserModel.php';
require_once 'view/UserView.php';
require_once 'controller/SessionController.php';

class UserController
{
    private $model;
    private $view;
    private $sessionController;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->sessionController = new SessionController();
    }
    function index()
    {
        $this->view->showLogup();
    }
    function show()
    {
        //controlar permiso
        $users = $this->model->getAll();
        $this->view->showUsers($users);
    }
    function add($user)
    {
        $user['permission'] = "standard";
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        $this->model->add($user);
        $userData = json_encode($user);
        AuthHelper::saveSession($userData);
        header("Location: " . BASE_URL . "home");
    }
}
