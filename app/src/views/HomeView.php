<?php

require_once './../vendor/autoload.php';
require_once './views/View.php';

class HomeView extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showHome($loggedIn, $admin, $errorMessage = '')
    {
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/homePage.tpl');
    }
}
