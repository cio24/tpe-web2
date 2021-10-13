<?php

require_once './../vendor/autoload.php';
include_once './helpers/AuthHelper.php';

class CareerListView
{
    private $smarty;


    function __construct()
    {
        $this->smarty = new Smarty();
    }
    function showList($data)
    {
        $isLoggedIn = AuthHelper::$isLoggedIn;
        $this->smarty->assign('isLoggedIn', $isLoggedIn);

        $data2 = json_decode(json_encode($data), true);
        $this->smarty->assign('data', $data2);
        $this->smarty->display('templates/CareerList.tpl');
    }

    function showCareer($careerData, $subjectsDataOfCareer)
    {
        $careerData = json_decode(json_encode($careerData), true);
        $subjectsDataOfCareer = json_decode(json_encode($subjectsDataOfCareer), true);
        $this->smarty->assign('careerData', $careerData[0]);
        $this->smarty->assign('subjectsDataOfCareer', $subjectsDataOfCareer);
        $this->smarty->display('templates/CareerData.tpl');
    }
}
