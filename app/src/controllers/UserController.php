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
        $this->view->showSignUp(AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
    }

    function show()
    {
        if (AuthHelper::checkAdmin()) {
            $userId = $_SESSION["USER_ID"];
            $users = $this->model->getAllWithout($userId);
            $this->view->showUsers($users, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
        } else
            $this->homeView->showHome(AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin(), "You are not an administrator.");
    }

    function add()
    {
        $user = $_POST;
        $userData = $this->model->getByEmail($user['email']);
        if (!$userData) {
            $user['permission'] = "0";
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->model->add($user);
            $userData = $this->model->getByEmail($user['email']);
            AuthHelper::saveSession($userData);
            header("Location: " . BASE_URL . "");
        } else
            $this->view->showSignUp(AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin(), 'User already exists');
    }

    function delete($params)
    { 
        if (!AuthHelper::checkAdmin())
            return $this->homeView->showNotFoundPage();

        $user = $this->model->get($params['pathParams'][':ID']);
        if (empty($user) || $user->id == $_SESSION['USER_ID'])
            return $this->homeView->showNotFoundPage();
        $this->model->delete($params['pathParams'][':ID']);
        header("Location: " . BASE_URL . "users");

    }

    function edit($params)
    {
        if(!AuthHelper::checkAdmin())
            return $this->homeView->showNotFoundPage();

        $user = $this->model->get($params['pathParams'][':ID']);
        if(empty($user) || $user->id == $_SESSION['USER_ID'])
            return $this->homeView->showNotFoundPage();
        
        $this->view->showEdit($user, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());

    }
    function update($params)
    {
        $userData = $_POST;
        if (AuthHelper::checkAdmin()) {
            $this->model->update($params['pathParams'][':ID'], $userData);
            header("Location:" . BASE_URL . "users");
        } else
            $this->homeView->showHome(AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin(), "You are not an administrator.");
    }
}
