<?php
require_once './models/CareerModel.php';
require_once './views/CareerView.php';
require_once './models/SubjectModel.php';

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

    function index($params = null, $errorMessage = '')
    {
        $careersData = $this->model->getAll();
        $this->view->showAll($careersData, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin(), $errorMessage);
    }

    function show($params)
    {
        $careerId = $params['pathParams'][':ID'];
        $careerData = $this->model->get($careerId);
        if (empty($careerData))
            return $this->view->showNotFoundPage();
        $subjectsDataOfCareer = $this->subjectModel->getFilteredByCareer($careerId);
        $this->view->showOne($careerData, $subjectsDataOfCareer, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
    }
    function add()
    {
        if (AuthHelper::checkAdmin()) {
            if (empty($_POST['name']) || empty($_POST['years']) || empty($_POST['faculty']))
                return $this->index(null, 'Fill in all fields');
            $career = $_POST;
            $this->model->add($career);
            $this->index(null, '');
        } else
            $this->index(null, "You are not an administrator.");
    }
    function delete($params)
    {
        $careerId = $params['pathParams'][':ID'];
        if (AuthHelper::checkAdmin()) {
            $career = $this->model->get($careerId);
            if (empty($career))
                return $this->index(null, "The career does not exist.");
            if ($this->model->delete($careerId))
                header("Location:" . BASE_URL . "careers");
            else
                $this->index(null, "This career cannot be delete 'cause it has subjects loaded");
        } else
            $this->index(null, "You are not an administrator.");
    }
    function edit($params)
    {
        if (AuthHelper::checkAdmin()) {
            $careerId = $params['pathParams'][':ID'];
            $career = $this->model->get($careerId);
            if (empty($career))
                return $this->index(null, "The career does not exist.");
            $this->view->showEdit($career, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
        } else
            $this->index(null, "You are not an administrator.");
    }
    function update($params)
    {
        if (AuthHelper::checkAdmin()) {
            if (empty($_POST['name']) || empty($_POST['years']) || empty($_POST['faculty']))
                return $this->index(null, 'Fill in all fields');
            $careerId = $params['pathParams'][':ID'];
            $career = $_POST;
            header("Location:" . BASE_URL . "careers");
            $this->model->update($careerId, $career);
            $careers = $this->model->getAll();
            $this->view->showAll($careers, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
        } else
            $this->index(null, "You are not an administrator.");
    }
}
