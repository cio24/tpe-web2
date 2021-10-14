<?php
require_once './model/CareerModel.php';
require_once './model/SubjectModel.php';
require_once './view/CareerView.php';

class CareerController
{
    private $model;     
    private $view;
    private $subjectModel;

    function __construct()
    {
        $this->model = new CareerModel();
        $this->subjectModel = new SubjectModel();
        $this->view = new CareerView();
    }
    
    function index()
    {
        $careersData = $this->model->getAll();
        $this->view->showAll($careersData);
    }

        function show($careerId)
    {
        $careerData = $this->model->get($careerId);
        $subjectsDataOfCareer = $this->subjectModel->getFilteredByCareer($careerId);
        $this->view->showCareer($careerData,$subjectsDataOfCareer);
    }
}
