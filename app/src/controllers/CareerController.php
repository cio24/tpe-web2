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

    function index($params)
    {
        $careersData = $this->model->getAll();
        $this->view->showAll($careersData, AuthHelper::checkLoggedIn(), '');
    }

    function show($params)
    {
        $careerId = $params[':ID'];
        $careerData = $this->model->get($careerId);
        $subjectsDataOfCareer = $this->subjectModel->getFilteredByCareer($careerId);
        $this->view->showOne($careerData, $subjectsDataOfCareer);
    }
    function add()
    {
        if (AuthHelper::checkLoggedIn()) {
            $career = $_POST;
            $this->model->add($career);
            $this->index('');
        } else
            $this->index("You are not an administrator.");
    }
    function delete($params)
    {
        $careerId = $params[':ID'];
        if (AuthHelper::checkLoggedIn()) {
            if($this->model->delete($careerId))
                header("Location:" . BASE_URL . "careers");
            else
                $this->index("This career cannot be delete 'cause it has subjects loaded");
        } else
            $this->index("You are not an administrator.");
    }
    function edit($params)
    {
        if (AuthHelper::checkLoggedIn()) {
            $careerId = $params[':ID'];
            $career = $this->model->get($careerId);
            $this->view->showEdit($career);
        } else
            $this->index("You are not an administrator.");
    }
    function update($params)
    {
        if (AuthHelper::checkLoggedIn()) {
            $careerId = $params[':ID'];
            $career = $_POST;
            header("Location:" . BASE_URL . "careers");
            $this->model->update($careerId, $career);
            $careers = $this->model->getAll();
            $this->view->showAll($careers, AuthHelper::checkLoggedIn());
        } else
            $this->index("You are not an administrator.");
    }
}
