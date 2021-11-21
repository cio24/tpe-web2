<?php

require_once 'models/UserModel.php';
require_once 'views/UserView.php';
require_once 'views/HomeView.php';
require_once 'helpers/AuthHelper.php';

class UserController
{
    private $model;
    private $view;
    private $homeView;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->homeView = new HomeView();
    }
    function index()
    {
        $this->view->showSignUp();
    }
    function show()
    {
        if (AuthHelper::checkAdmin()) {
            $users = $this->model->getAll();
            $this->view->showUsers($users);
        } else
            $this->homeView->showHome("You are not an administrator.");
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
        } else
            $this->view->showSignUp('User already exists');
    }
    function delete($params)
    {
        if (AuthHelper::checkAdmin()) {
            $this->model->delete($params[':ID']);
            header("Location: " . BASE_URL . "users");
        } else
            $this->homeView->showHome("You are not an administrator.");
    }
    function edit($params)
    {
        if (AuthHelper::checkAdmin()) {
            $user = $this->model->get($params[':ID']);
            $this->view->showEdit($user);
        } else
            $this->homeView->showHome("You are not an administrator.");
    }
    function update($params)
    {
        $userData = $_POST;
        if (AuthHelper::checkAdmin()) {
            $this->model->update($params[':ID'], $userData);
            header("Location:" . BASE_URL . "users");
        } else
            $this->homeView->showHome("You are not an administrator.");
    }
}
