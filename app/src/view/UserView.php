<?php

require_once './../vendor/autoload.php';

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showLogup($errorMessage = '')
    {
        $this->smarty->assign($errorMessage);
        $this->smarty->display('templates/logup.tpl');
    }
    function showUsers($users)
    {
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/users.tpl');
    }
    function showEdit($user)
    {
        $this->smarty->assign('user', $user);
        $this->smarty->display('templates/userEdit.tpl');
    }
}
