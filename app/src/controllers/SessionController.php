<?php

include_once './views/SessionView.php';
include_once './views/HomeView.php';
include_once './models/UserModel.php';
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

    function verifyUser()
    {
        //getting the form data loaded by the user 
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];

        //getting (if exists) the user data associated with the given email 
        $user = $this->userModel->get($email);

        //save the session if the password is correct
        if (!empty($user) && password_verify($password, $user->password)) {
            //session_start();
            AuthHelper::saveSession($user->email);
            header("Location: " . BASE_URL . "home");
            $this->homeView->showHome();
        } else
            $this->loginView->showLogin("This user is not registered or the information is wrong");
    }
}
