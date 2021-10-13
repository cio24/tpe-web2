<?php
require_once './model/SubjectModel.php';
require_once './view/SubjectListView.php';
class SubjectsListController
{
    private $model;
    private $modelCareer;
    private $view;

    function __construct()
    {
        $this->model = new SubjectModel();
        $this->view = new SubjectListView();
        $this->modelCareer=new CareerModel();
    }

    function listSubjects()
    {
        $subjects = $this->model->getAllSubjects();
        $careers=$this->modelCareer->getAllCareers();
        $this->view->showList($subjects,$careers);
    }

    function show($subjectId)
    {
        $subjectData = $this->model->get($subjectId);
        $this->view->showSubject($subjectData);
    }
    function add($subject)
    {
        $this->model->add($subject);
        $this->listSubjects();
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
