<?php

require_once './../vendor/autoload.php';

class HomeView
{
    private $smarty;
    
    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showHome()
    {
        $action = AuthHelper::checkLoggedIn() ? 'logout' : 'login';

        $this->smarty->assign('action', $action);
        $this->smarty->display('templates/home.tpl');
    }
}
