<?php
require_once './models/SubjectModel.php';
require_once './views/SubjectView.php';
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
        $this->view->showAll($subjectsData, $careersData, AuthHelper::checkLoggedIn(),'');
    }

    function show($params)
    {   
        $subjectData = $this->model->get($params[':ID']);
        $this->view->showSubject($subjectData);
    }

    function add()
    {
        $subjectData = $_POST;
        if (AuthHelper::checkLoggedIn()) {
            $this->model->add($subjectData);
            $this->index();
        } else
            $this->index("You are not an administrator.");
    }

    function delete($params)
    {
        if (AuthHelper::checkLoggedIn()) {
            $subjectId = $params[':ID'];
            if ($this->model->delete($subjectId))
                header("Location:" . BASE_URL . "subjects");
            else
                $this->index("This subjects cannot be delete 'cause is a requirement of another subject.");
        } else
            $this->index("You are not an administrator.");
    }
    function edit($params)
    {
        if (AuthHelper::checkLoggedIn()) {
            $subjectId = $params[':ID'];
            $subjects = $this->model->getAll();
            $careers = $this->modelCareer->getAll();
            $subject = $this->model->get($subjectId);
            $this->view->showEdit($subject, $subjects, $careers);
        } else
            $this->index("You are not an administrator.");
    }
    function update($params)
    {
        if (AuthHelper::checkLoggedIn()) {
            $subjectId = $params[':ID'];
            print_r($subjectId);
            $subject = $_POST;
            $this->model->update($subjectId, $subject);
            $this->index();
        } else
            $this->index("You are not an administrator.");
    }
}
