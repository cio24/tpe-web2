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

    function index($params = null, $mesagge = '')
    {
        $subjectsData = $this->model->getAll();
        $careersData = $this->modelCareer->getAll();
        $this->view->showAll($subjectsData, $careersData, AuthHelper::checkLoggedIn(), $mesagge);
    }

    function show($params)
    {
        $subjectData = $this->model->get($params[':ID']);
        $this->view->showSubject($subjectData);
    }

    function add()
    {
        if (!AuthHelper::checkAdmin())
            return $this->index("You are not an administrator.");

        // is an admin so we check if there are all required data

        $subjectData = $_POST; 
        $errors = $this->validateSubjectData($subjectData);
        if (count($errors) > 0) {
            // print errors
            $errorsStrings = '';
            foreach ($errors as $error)
                $errorsStrings .= $error . '<br>';
            return $this->index($errorsStrings);
        }


        // no errors so we can add the subject

        // if the subject has not a requirement we change the string to a null value por the database
        if ($subjectData['direct_requirement'] == "null")
            $subjectData['direct_requirement'] = null;

            
        // Get the info of the image loaded
        $tempImageFile = $_FILES['input_image']['tmp_name'];
        $tempImageName = $_FILES['input_image']['name'];

        // if the image is not empty
        if(!empty($tempImageFile)){
            $imagePath = 'assets/images/subjects/' . uniqid() . "." . strtolower(pathinfo($tempImageName, PATHINFO_EXTENSION));
    
            $this->model->add($subjectData, $tempImageFile, $imagePath);
        }
        else
            $this->model->add($subjectData);
        
        return $this->index("The subject has been created.");
    }


    function validateSubjectData($subjectData)
    {
        $errors = [];

        if (empty($subjectData['semester']))
            $errors['semester'] = 'Semester is required.';

        if (empty($subjectData['year']))
            $errors['year'] = 'Year is required.';

        if (empty($subjectData['name']))
            $errors['name'] = 'Name is required.';

        if (empty($subjectData['career']))
            $errors['career'] = 'Career is required.';

        return $errors;
    }

    function isImageTypeValid($type)
    {
        return ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg');
    }

    function delete($params)
    {
        if (AuthHelper::checkAdmin()) {
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
        if (AuthHelper::checkAdmin()) {
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
        if (AuthHelper::checkAdmin()) {
            $subjectId = $params[':ID'];
            $subject = $_POST;
            $this->model->update($subjectId, $subject);
            $this->index();
        } else
            $this->index("You are not an administrator.");
    }
}
