<?php

include_once './view/SessionView.php';
include_once './model/UserModel.php';
include_once './helpers/AuthHelper.php';

class SessionController
{

    private $view;
    private $userModel;

    function __construct()
    {
        $this->view = new SessionView();
        $this->userModel = new UserModel();
    }

    function index()
    {
        $this->view->showLogin('');
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
            session_start();
            AuthHelper::saveSession($user->email);
            header("Location: " . BASE_URL . "home");
        } else
            $this->view->showLogin("This user is not registered or the information is wrong");
    }
}
