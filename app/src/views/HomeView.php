<?php

require_once './../vendor/autoload.php';

class HomeView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showHome($errorMessage = '')
    {
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';

        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('action', $action);
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $this->smarty->display('templates/home.tpl');
    }
}
