<?php

require_once 'model/UserModel.php';
require_once 'view/UserView.php';

class UserController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
    }
    function index()
    {
        $this->view->showLogup();
    }
    function show()
    {
        //controlar permiso
        $users=$this->model->getAll();
        $this->view->showUsers($users);
    }
    function add($user)
    {
        header("Location:" . BASE_URL . "login");
        $user['password']=password_hash($user['password'],PASSWORD_DEFAULT);
        $this->model->add($user);
    }
}
