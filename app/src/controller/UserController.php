<?php

require_once 'model/UserModel.php';
require_once 'view/UserView.php';
require_once 'controller/SessionController.php';
require_once 'helpers/AuthHelper.php';

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
        if (AuthHelper::checkAdmin()) {
            $users = $this->model->getAll();
            $this->view->showUsers($users);
        } else {
            header("Location: " . BASE_URL . "home");
        }
    }
    function add()
    {
        $user = $_POST;
        $userData = $this->model->get($user['email']);
        if (!$userData) {
            $user['permission'] = "standard";
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->model->add($user);
            $userData = $this->model->get($user['email']);
            AuthHelper::saveSession($userData);
            header("Location: " . BASE_URL . "home");
        } else {
            echo 'El usuario ya existe';
        }
    }
    function delete($params)
    {
        if (AuthHelper::checkAdmin()) {
            $this->model->delete($params[':ID']);
            header("Location: " . BASE_URL . "users");
        }
    }
    function edit($params)
    {
        if (AuthHelper::checkAdmin()) {
            $user = $this->model->get($params[':ID']);
            $this->view->showEdit($user);
        } else
            $this->index("You are not an administrator.");
    }
    function update($params)
    {
        $userData = $_POST;
        if (AuthHelper::checkAdmin()) {
            $this->model->update($params[':ID'], $userData);
            header("Location:" . BASE_URL . "users");
        } else
            $this->index("You are not an administrator.");
    }
}
