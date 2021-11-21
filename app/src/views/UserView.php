<?php

require_once './../vendor/autoload.php';

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showSignUp($loggedIn, $admin, $errorMessage = '')
    {
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/signUpPage.tpl');
    }
    function showUsers($users, $loggedIn, $admin)
    {
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/usersPage.tpl');
    }
    function showEdit($user, $loggedIn, $admin)
    {
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('user', $user);
        $this->smarty->display('templates/userEditPage.tpl');
    }
}
