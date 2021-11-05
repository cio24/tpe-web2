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
    function showAll($careers,$isLoggedIn, $errorMessage="")
    {
        $this->smarty->assign('isLoggedIn', $isLoggedIn);
        $this->smarty->assign('data', $careers);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/CareerList.tpl');
    }

    function showOne($careerData, $subjectsDataOfCareer)
    {
        $this->smarty->assign('careerData', $careerData);
        $this->smarty->assign('subjectsDataOfCareer', $subjectsDataOfCareer);
        $this->smarty->display('templates/CareerData.tpl');
    }
    function showEdit($career)
    {
        $this->smarty->assign('career',$career);
        $this->smarty->display('templates/careerEdit.tpl');
    }
}
