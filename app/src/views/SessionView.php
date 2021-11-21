<?php

require_once './../vendor/autoload.php';

class SessionView
{

    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showLogin($loggedIn, $admin, $errorMessage = '')
    {
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/signInPage.tpl');
    }
}
