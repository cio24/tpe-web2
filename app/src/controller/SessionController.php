<?php

include_once './view/SessionView.php';
include_once './view/HomeView.php';
include_once './model/UserModel.php';
include_once './helpers/AuthHelper.php';

class SessionController
{
    private $loginView;
    private $userModel;

    function __construct()
    {
        $this->loginView = new SessionView();
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

    function verifyUser()
    {
        //getting (if exists) the user data associated with the given email 
        $userData = $this->userModel->get($_POST['email']);

        //save the session if the password is correct
        if (!empty($userData) && password_verify($_POST['password'], $userData->password)) {
            AuthHelper::saveSession($userData);
            header("Location: " . BASE_URL . "home");
        } else
            $this->loginView->showLogin("This user is not registered or the information is wrong");
    }
}
