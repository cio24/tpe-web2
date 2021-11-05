<?php
require_once './views/HomeView.php';

class HomeController
{
    private $view;
    private $HomeView;

    function __construct()
    {
        $this->view = new HomeView();
    }

    function index()
    {
        $this->view->showHome();
    }
}
