<?php

require_once './../vendor/autoload.php';

class SubjectView
{
    private $smarty;


    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showSearchResult($subjectData, $action, $careerData)
    {
        $this->smarty->assign('subjectData', $subjectData);
        $this->smarty->assign('action', $action);
        $this->smarty->assign('careerData', $careerData);
        $this->smarty->assign('subjectsData', $subjectData);
        $this->smarty->assign('errorMessage', '');
        $this->smarty->display('templates/subjectsSearchResultPage.tpl');
    }

    function showAll($subjectData, $careersData, $logged, $errorMessage, $pageNumber, $maxPageNumber)
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('subjectsData', $subjectData);
        $this->smarty->assign('careersData', $careersData);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->assign('logged', $logged);
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

    function showEdit($subject, $subjects, $careers)
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('careersData', $careers);
        $this->smarty->assign('subject', $subject);
        $this->smarty->assign('addOrUpdate', "update");
        $this->smarty->display('templates/subjectEditPage.tpl');
    }

    public function showSubjectsSearcher()
    {
        $this->smarty->display('templates/subjectsSearcherPage.tpl');
    }
}
