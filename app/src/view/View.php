<?php
require_once 'libs/smarty-master/libs/Smarty.class.php';
class View
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showHome($data)
    {
        var_dump($data);
        $this->smarty->display('templates/home.tpl');
    }
}
