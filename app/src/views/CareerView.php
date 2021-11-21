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
    function showAll($careers, $loggedIn, $admin, $errorMessage = "")
    {
        $action = $loggedIn ? 'out' : 'in';
        $this->smarty->assign('loggedIn', $loggedIn);
        $this->smarty->assign('action', $action);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('data', $careers);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/careersPage.tpl');
    }

    function showOne($careerData, $subjectsDataOfCareer, $loggedIn, $admin)
    {
        $this->smarty->assign('admin', $admin);
        $action = $loggedIn ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('careerData', $careerData);
        $this->smarty->assign('subjectsDataOfCareer', $subjectsDataOfCareer);
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $this->smarty->display('templates/careerPage.tpl');
    }
    function showEdit($career, $loggedIn, $admin)
    {
        $this->smarty->assign('admin', $admin);
        $action = $loggedIn ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('career', $career);
        $this->smarty->display('templates/careerEditPage.tpl');
    }
}
