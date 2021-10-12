<?php

include_once './view/AuthView.php';
include_once './model/UserModel.php';
// include_once './Helpers/AuthHelper.php';

class AuthController
{

    private $view;
    private $userModel;

    function __construct()
    {
        $this->view = new authView();
        $this->userModel = new UserModel();
    }

    function validateUser()
    {
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $user = $this->userModel->get($email);

        if ($user && password_verify($password, $user->password) && ($email == $user->email)) {
            // authHelper::login($user);
            header("Location: " . BASE_URL . "home");
        } else{
            $this->view->showLogin("This user is not registered or the information is wrong");
        }
    }

    function logout()
    {
        // authHelper::logout();
        header("Location:" . BASE_URL . "home");
    }
}
