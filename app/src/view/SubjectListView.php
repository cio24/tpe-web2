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
    function showList($subjects,$careers)
    {
        $jsonSubjects = json_decode(json_encode($subjects), true);
        $jsonCareers = json_decode(json_encode($careers), true);
        $this->smarty->assign('subjects',$jsonSubjects);
        $this->smarty->assign('careers',$jsonCareers);
        $this->smarty->display('templates/SubjectList.tpl');
    }
    function showSubject($subjectData){
        $subjectData = json_decode(json_encode($subjectData), true);
        $this->smarty->assign('subjectData', $subjectData[0]);
        $this->smarty->display('templates/SubjectData.tpl');
    }
    function showEdit($subject,$subjects,$careers)
    {
        $jsonSubjects = json_decode(json_encode($subjects), true);
        $jsonCareers = json_decode(json_encode($careers), true);
        $jsonSubject = json_decode(json_encode($subject), true);
        $this->smarty->assign('subjects',$jsonSubjects);
        $this->smarty->assign('careers',$jsonCareers);
        $this->smarty->assign('subject',$subject);
        $this->smarty->display('templates/subjectEdit.tpl');
    }
}
