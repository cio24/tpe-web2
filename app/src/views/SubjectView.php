<?php

require_once './../vendor/autoload.php';

class SubjectView
{
    private $smarty;
    

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showAll($subjectData, $careersData,$logged, $errorMessage)
    {
        $this->smarty->assign('subjectsData', $subjectData);
        $this->smarty->assign('careersData', $careersData);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('logged',$logged);
        $this->smarty->assign('addOrUpdate', 'add');
        $this->smarty->display('templates/subjects.tpl');
    }
    
    function showSubject($subjectData){
        $this->smarty->assign('subjectData', $subjectData);
        $this->smarty->display('templates/SubjectData.tpl');
    }
    function showEdit($subject,$subjects,$careers)
    {
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('careersData', $careers);
        $this->smarty->assign('subject',$subject);
        $this->smarty->assign('addOrUpdate',"update");
        $this->smarty->display('templates/subjectEdit.tpl');
    }
}
