<?php

require_once './../vendor/autoload.php';
require_once './views/View.php';

class SubjectView extends View
{
    
    public function __construct()
    {
        parent::__construct();
    }

    function showSearchResult($subjectData, $careerData, $loggedIn, $admin, $haveResults, $errorMessage = '')
    {
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('subjectData', $subjectData);
        $this->smarty->assign('careerData', $careerData);
        $this->smarty->assign('subjectsData', $subjectData);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('haveResults', $haveResults);
        $this->smarty->display('templates/subjectsSearchResultPage.tpl');
    }

    function showAll($subjectData, $careersData, $loggedIn, $admin, $errorMessage, $pageNumber, $maxPageNumber)
    {
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('subjectsData', $subjectData);
        $this->smarty->assign('careersData', $careersData);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('addOrUpdate', 'add');
        $this->smarty->assign('pageNumber', $pageNumber);
        $this->smarty->assign('maxPageNumber', $maxPageNumber);
        $this->smarty->display('templates/subjectsPage.tpl');
    }

    function showSubject($subjectData, $userId, $loggedIn, $admin)
    {
        $this->smarty->assign('subjectData', $subjectData);
        $this->smarty->assign('userId', $userId);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/SubjectPage.tpl');
    }

    function showEdit($subject, $subjects, $careers, $loggedIn, $admin)
    {
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('careersData', $careers);
        $this->smarty->assign('subject', $subject);
        $this->smarty->assign('addOrUpdate', "update");
        $this->smarty->display('templates/subjectEditPage.tpl');
    }

    public function showSubjectsSearcher($loggedIn, $admin)
    {
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/subjectsSearcherPage.tpl');
    }
}
