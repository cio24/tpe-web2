<?php

require_once './../vendor/autoload.php';

class SubjectView
{
    private $smarty;


    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showAll($subjectData, $careersData, $logged, $errorMessage)
    {
        $this->smarty->assign('subjectsData', $subjectData);
        $this->smarty->assign('careersData', $careersData);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('logged', $logged);
        $this->smarty->display('templates/subjects.tpl');
    }

    function showSubject($subjectData, $userId, $loggedIn, $admin)
    {
        $this->smarty->assign('subjectData', $subjectData);
        $this->smarty->assign('userId', $userId);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/SubjectData.tpl');
    }
    function showEdit($subject, $subjects, $careers)
    {
        $jsonSubjects = json_decode(json_encode($subjects), true);
        $jsonCareers = json_decode(json_encode($careers), true);
        $jsonSubject = json_decode(json_encode($subject), true);
        $this->smarty->assign('subjects', $jsonSubjects);
        $this->smarty->assign('careers', $jsonCareers);
        $this->smarty->assign('subject', $subject);
        $this->smarty->display('templates/subjectEdit.tpl');
    }
}
