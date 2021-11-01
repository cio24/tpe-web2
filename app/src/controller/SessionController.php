<?php

include_once './view/SessionView.php';
include_once './view/HomeView.php';
include_once './model/UserModel.php';
include_once './helpers/AuthHelper.php';

class SessionController
{

    private $loginView;
    private $homeView;
    private $userModel;

    function __construct()
    {
        $this->loginView = new SessionView();
        $this->homeView = new HomeView();
        $this->userModel = new UserModel();
    }

    function index()
    {
        $this->loginView->showLogin('');
    }

    function logout()
    {
        session_start();
        session_destroy();
        header("Location:" . BASE_URL . "home");
    }

    function verifyUser($user)
    {
        //getting (if exists) the user data associated with the given email 
        $userData = $this->userModel->get($user['email']);

        //save the session if the password is correct
        if (!empty($userData) && password_verify($user['password'], $userData->password)) {
            //session_start();
            AuthHelper::saveSession($userData);
            header("Location: " . BASE_URL . "home");
        } else
            $this->loginView->showLogin("This user is not registered or the information is wrong");
    }
}
