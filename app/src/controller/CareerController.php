<?php
require_once './model/CareerModel.php';
require_once './view/CareerView.php';
require_once './model/SubjectModel.php';

class CareerController
{
    private $model;     
    private $view;
    private $subjectModel;

    function __construct()
    {
        $this->model = new CareerModel();
        $this->view = new CareerView();
        $this->subjectModel = new SubjectModel();
    }
    
    function index()
    {
        $careersData = $this->model->getAll();
        $this->view->showAll($careersData,AuthHelper::checkLoggedIn());
    }

        function show($careerId)
    {
        $careerData = $this->model->get($careerId);
        $subjectsDataOfCareer = $this->subjectModel->getFilteredByCareer($careerId);
        $this->view->showOne($careerData,$subjectsDataOfCareer);
    }
    function add($career)
    {
        header("Location:" . BASE_URL . "careers");
        $this->model->add($career);
        $this->index();
    }
    function delete($careerId)
    {
        header("Location:" . BASE_URL . "careers");
        $this->model->delete($careerId);
        $this->index();
    }
    function edit($careerId)
    {
        $career=$this->model->get($careerId);
        //header("Location:" . BASE_URL . "subjects/edit"); no tengo donde redirigir
        $this->view->showEdit($career);
    }
    function update($careerId,$career)
    {
        header("Location:" . BASE_URL . "careers");
        $this->model->update($careerId,$career);
        $careers=$this->model->getAll();
        $this->view->showAll($careers,AuthHelper::checkLoggedIn());
    }
}
