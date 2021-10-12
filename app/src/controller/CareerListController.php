<?php
require_once './model/CareerModel.php';
require_once './model/SubjectModel.php';
require_once './view/CareerListView.php';
class CareersListController
{
    private $model;
    private $view;
    private $subjectModel;

    function __construct()
    {
        $this->model = new CareerModel();
        $this->subjectModel = new SubjectModel();

        $this->view = new CareerListView();
    }
    function listCareers()
    {
        $data = $this->model->getAllCareers();
        $this->view->showList($data);
    }

        function show($careerId)
    {
        $careerData = $this->model->get($careerId);
        $subjectsDataOfCareer = $this->subjectModel->getSubjects($careerId);
        $this->view->showCareer($careerData,$subjectsDataOfCareer);
    }
}
