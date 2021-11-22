<?php

require_once './../vendor/autoload.php';

class View
{
    protected $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showNotFoundPage()
    {
        $this->smarty->display('templates/notFoundPage.tpl');
    }
}
