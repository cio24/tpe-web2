<?php

require_once './../vendor/autoload.php';

class HomeView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showHome($loggedIn, $admin, $errorMessage = '')
    {
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/homePage.tpl');
    }
}
