<?php
require_once './model/SubjectModel.php';
require_once './view/SubjectListView.php';
class SubjectsListController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new SubjectModel();
        $this->view = new SubjectListView();
    }
    function listSubjects()
    {
        $data = $this->model->getAllSubjects();
        $this->view->showList($data);
    }
}
