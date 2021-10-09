<?php

require_once './../vendor/autoload.php';
// echo getcwd() . "\n";
class SubjectListView
{
    private $smarty;
    

    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showList($data)
    {
        $this->smarty->assing('data',$data);
        $this->smarty->display('templates/SubjectList.tpl');
    }
}
