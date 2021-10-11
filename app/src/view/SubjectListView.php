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
        $data2 = json_decode(json_encode($data), true);
        $this->smarty->assign('data',$data2);
        $this->smarty->display('templates/SubjectList.tpl');
    }
}
