<?php
require_once './model/Model.php';
require_once './view/View.php';
class Controller
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }
    function Home()
    {
        $data = $this->model->getData();
        $this->view->showHome($data);
    }
}
