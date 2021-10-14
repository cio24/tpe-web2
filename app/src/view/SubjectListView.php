<?php

require_once './../vendor/autoload.php';
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
    
    function showSubject($subjectData){
        $subjectData = json_decode(json_encode($subjectData), true);
        $this->smarty->assign('subjectData', $subjectData[0]);
        $this->smarty->display('templates/SubjectData.tpl');
    }
}
