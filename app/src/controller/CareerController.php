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

    function index($errorMessage="")
    {
        $careersData = $this->model->getAll();
        $this->view->showAll($careersData, AuthHelper::checkLoggedIn(), $errorMessage);
    }

    function show($careerId)
    {
        $careerData = $this->model->get($careerId);
        $subjectsDataOfCareer = $this->subjectModel->getFilteredByCareer($careerId);
        $this->view->showOne($careerData, $subjectsDataOfCareer);
    }
    function add($career)
    {
        if (AuthHelper::checkLoggedIn()) {
            header("Location:" . BASE_URL . "careers");
            $this->model->add($career);
            $this->index();
        } else
            $this->index("You are not an administrator.");
    }
    function delete($careerId)
    {
        if (AuthHelper::checkLoggedIn()) {
            if($this->model->delete($careerId))
                header("Location:" . BASE_URL . "careers");
            else
                $this->index("This career cannot be delete 'cause it has subjects loaded");
        } else
            $this->index("You are not an administrator.");
    }
    function edit($careerId)
    {
        if (AuthHelper::checkLoggedIn()) {
            $career = $this->model->get($careerId);
            //header("Location:" . BASE_URL . "subjects/edit"); no tengo donde redirigir
            $this->view->showEdit($career);
        } else
            $this->index("You are not an administrator.");
    }
    function update($careerId, $career)
    {
        if (AuthHelper::checkLoggedIn()) {
            header("Location:" . BASE_URL . "careers");
            $this->model->update($careerId, $career);
            $careers = $this->model->getAll();
            $this->view->showAll($careers, AuthHelper::checkLoggedIn());
        } else
            $this->index("You are not an administrator.");
    }
}
