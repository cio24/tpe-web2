<?php
require_once './model/SubjectModel.php';
require_once './view/SubjectView.php';
require_once './helpers/AuthHelper.php';


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
        $this->view->showAll($subjectsData, $careersData,AuthHelper::checkLoggedIn());
    }

    function show($subjectId)
    {
        $subjectData = $this->model->get($subjectId);
        $this->view->showSubject($subjectData);
    }
    function add($subject)
    {
        header("Location:" . BASE_URL . "subjects");
        $this->model->add($subject);
        $this->index();
    }
    function delete($subjectId)
    {
        header("Location:" . BASE_URL . "subjects");
        $this->model->delete($subjectId);
        $this->index();
    }
    function edit($subjectId)
    {
        $subjects=$this->model->getAll();
        $careers=$this->modelCareer->getAll();
        $subject=$this->model->get($subjectId);
        //header("Location:" . BASE_URL . "subjects/edit"); no tengo donde redirigir
        $this->view->showEdit($subject,$subjects,$careers);
    }
    function update($subjectId,$subject)
    {
        header("Location:" . BASE_URL . "subjects");
        $this->model->update($subjectId,$subject);
        $subjects=$this->model->getAll();
        $careers=$this->modelCareer->getAll();
        $this->view->showAll($subjects,$careers,AuthHelper::checkLoggedIn());
    }
}
