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
    function showAll($data)
    {
        $isLoggedIn = AuthHelper::checkLoggedIn();
        $this->smarty->assign('isLoggedIn', $isLoggedIn);

        $data2 = json_decode(json_encode($data), true);
        $this->smarty->assign('data', $data2);
        $this->smarty->display('templates/CareerList.tpl');
    }

    function showOne($careerData, $subjectsDataOfCareer)
    {
        $this->smarty->assign('careerData', $careerData);
        $this->smarty->assign('subjectsDataOfCareer', $subjectsDataOfCareer);

        $this->smarty->display('templates/CareerData.tpl');
    }
}
