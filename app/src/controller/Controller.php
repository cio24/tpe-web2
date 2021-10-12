<?php
require_once './model/Model.php';
require_once './view/View.php';
require_once './view/AuthView.php';
class Controller
{
    private $model;
    private $view;
    private $authView;

    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->authView = new AuthView();
    }
    function Home()
    {
        $data = $this->model->getData();
        $this->view->showHome($data);
    }
    function login(){
        $this->authView->showLogin('');
    }
}
