<?php

require_once './../vendor/autoload.php';

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showSignUp($errorMessage = '')
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/signUpPage.tpl');
    }
    function showUsers($users)
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/usersPage.tpl');
    }
    function showEdit($user)
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('user', $user);
        $this->smarty->display('templates/userEditPage.tpl');
    }
}
