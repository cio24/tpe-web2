<?php
require_once './views/HomeView.php';

class HomeController
{
    private $view;

    function __construct()
    {
        $this->view = new HomeView();
    }

    function index()
    {
        $this->view->showHome(AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
    }

    function showNotFoundPage(){
        $this->view->showNotFoundPage();
    }
}
