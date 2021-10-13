<?php

require_once './../vendor/autoload.php';
// echo getcwd() . "\n";
class View
{
    private $smarty;
    

    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showHome()
    {
        $this->smarty->display('templates/home.tpl');
    }
    function showLogin(){
        $this->smarty->display('templates/login.tpl');
    }
}
