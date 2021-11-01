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
    function add($user)
    {
        $user['permission'] = "standard";
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        $this->model->add($user);
        $userData = json_encode($user);
        AuthHelper::saveSession($userData);
        header("Location: " . BASE_URL . "home");
    }
    function delete($userId)
    {
        if (AuthHelper::checkAdmin()) {
            $this->model->delete($userId);
            header("Location: " . BASE_URL . "users");
        }
    }
    function edit($userId)
    {
        if (AuthHelper::checkAdmin()) {
            $user = $this->model->get($userId);
            $this->view->showEdit($user);
        } else
            $this->index("You are not an administrator.");
    }
    function update($userId, $userData)
    {
        if (AuthHelper::checkAdmin()) {
            $this->model->update($userId, $userData);
            header("Location:" . BASE_URL . "users");
        } else
            $this->index("You are not an administrator.");
    }
}
