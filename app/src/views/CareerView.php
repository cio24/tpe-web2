<?php

require_once './../vendor/autoload.php';
include_once './helpers/AuthHelper.php';

class CareerView
{
    private $smarty;


    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showAll($careers, $admin, $errorMessage = "")

    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('data', $careers);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/careersPage.tpl');
    }

    function showOne($careerData, $subjectsDataOfCareer)
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('careerData', $careerData);
        $this->smarty->assign('subjectsDataOfCareer', $subjectsDataOfCareer);
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $this->smarty->display('templates/careerPage.tpl');
    }
    function showEdit($career)
    {
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('career', $career);
        $this->smarty->display('templates/careerEditPage.tpl');
    }
}
