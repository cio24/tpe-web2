<?php

require_once './../vendor/autoload.php';
include_once './helpers/AuthHelper.php';
require_once './views/View.php';


class CareerView extends View
{
        public function __construct()
        {
                parent::__construct();
        }
        
        function showAll($careers, $loggedIn, $admin, $errorMessage = "")
        {
                $this->smarty->assign('loggedIn', $loggedIn);
                $this->smarty->assign('admin', $admin);
                $this->smarty->assign('data', $careers);
                $this->smarty->assign('errorMessage', $errorMessage);
                $this->smarty->display('templates/careersPage.tpl');
        }

        function showOne($careerData, $subjectsDataOfCareer, $loggedIn, $admin)
        {
                $this->smarty->assign('admin', $admin);
                $this->smarty->assign('loggedIn', $loggedIn);
                $this->smarty->assign('careerData', $careerData);
                $this->smarty->assign('subjectsDataOfCareer', $subjectsDataOfCareer);
                $this->smarty->display('templates/careerPage.tpl');
        }
        function showEdit($career, $loggedIn, $admin)
        {
                $this->smarty->assign('admin', $admin);
                $this->smarty->assign('loggedIn', $loggedIn);
                $this->smarty->assign('career', $career);
                $this->smarty->display('templates/careerEditPage.tpl');
        }
}
