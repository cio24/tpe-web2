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

    function index($errorMessage="")
    {
        $subjectsData = $this->model->getAll();
        $careersData = $this->modelCareer->getAll();
        $this->view->showAll($subjectsData, $careersData,AuthHelper::checkLoggedIn(),$errorMessage);
    }

    function show($subjectId)
    {
        $subjectData = $this->model->get($subjectId);
        $this->view->showSubject($subjectData);
    }
    function add($subject)
    {
        $this->model->add($subject);
        header("Location:" . BASE_URL . "subjects");
    }
    function delete($subjectId)
    {
        if($this->model->delete($subjectId))
            header("Location:" . BASE_URL . "subjects");
        else
            $this->index("This subjects cannot be delete 'cause is a requirement of another subject.");
    }
    function edit($subjectId)
    {
        $subjects=$this->model->getAll();
        $careers=$this->modelCareer->getAll();
        $subject=$this->model->get($subjectId);
        $this->view->showEdit($subject,$subjects,$careers);
    }
    function update($subjectId,$subject)
    {
        $this->model->update($subjectId,$subject);
        header("Location:" . BASE_URL . "subjects");
        $subjects=$this->model->getAll();
        $careers=$this->modelCareer->getAll();
    }
}
