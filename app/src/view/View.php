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
    function showHome($data)
    {
        $this->smarty->display('templates/home.tpl');
    }
}
