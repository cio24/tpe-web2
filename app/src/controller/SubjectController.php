<?php
require_once './model/SubjectModel.php';
require_once './view/SubjectView.php';

class SubjectController
{
    private $model;
    private $modelCareer;
    private $view;

    function __construct()
    {
        $this->model = new SubjectModel();
        $this->view = new SubjectView();
        $this->modelCareer = new CareerModel();
    }

    function index()
    {
        $subjectsData = $this->model->getAll();
        $careersData = $this->modelCareer->getAll();
        $this->view->showAll($subjectsData, $careersData);
    }

    function show($subjectId)
    {
        $subjectData = $this->model->get($subjectId);
        $this->view->showSubject($subjectData);
    }
    function add($subject)
    {
        $this->model->add($subject);
        $this->index();
        header("Location:" . BASE_URL . "subjects");
    }
    function delete($subjectId)
    {
        $this->model->delete($subjectId);
        $this->listSubjects();
        header("Location:" . BASE_URL . "subjects");
    }
    function edit($subjectId)
    {
        $subjects=$this->model->getAllSubjects();
        $careers=$this->modelCareer->getAllCareers();
        $subject=$this->model->get($subjectId);
        $this->view->showEdit($subject,$subjects,$careers);
    }
    function sendEdit($subjectId,$subject)
    {
        $this->model->update($subjectId,$subject);
        $subjects=$this->model->getAllSubjects();
        $careers=$this->modelCareer->getAllCareers();
        $this->view->showList($subjects,$careers);
    }
}
