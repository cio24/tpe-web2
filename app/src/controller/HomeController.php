<?php
require_once './view/HomeView.php';

class HomeController
{
    private $view;

    function __construct()
    {
        $this->view = new HomeView();
    }

    function index()
    {
        $this->view->showHome();
    }
}
