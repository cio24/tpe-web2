<?php

include_once './view/AuthView.php';
include_once './model/UserModel.php';
include_once './helpers/AuthHelper.php';

class AuthController
{

    private $view;
    private $userModel;

    function __construct()
    {
        $this->view = new authView();
        $this->userModel = new UserModel();
    }

    function verifyUser()
    {
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $user = $this->userModel->get($email);

        if (!empty($user) && password_verify($password, $user->password)) {
            AuthHelper::saveSession($user);
            header("Location: " . BASE_URL . "home");
        } else {
            print_r("encrypt: {$user->password}, password {$password}");

            $this->view->showLogin("This user is not registered or the information is wrong");
        }
    }

    function logout()
    {
        // authHelper::logout();
        header("Location:" . BASE_URL . "home");
    }
}
