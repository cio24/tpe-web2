<?php
require_once './models/SubjectModel.php';
require_once './views/SubjectView.php';
require_once './helpers/AuthHelper.php';


class SubjectController
{
    private $model;
    private $modelCareer;
    private $view;

    public function __construct()
    {
        $this->model = new SubjectModel();
        $this->view = new SubjectView();
        $this->modelCareer = new CareerModel();
    }

    public function index($params = null, $mesagge = '')
    {
        $subjectsData = $this->model->getAll();
        $careersData = $this->modelCareer->getAll();
        $this->view->showAll($subjectsData, $careersData, AuthHelper::checkLoggedIn(), $mesagge);
    }

    public function show($params)
    {
        $subjectData = $this->model->get($params[':ID']);
        $this->view->showSubject($subjectData);
    }

    public function edit($params)
    {
        if (AuthHelper::checkAdmin()) {
            $subjectId = $params[':ID'];
            $subject = $this->model->get($subjectId);
            if (empty($subject))
                return $this->index(null, "The subject does not exist.");

            $subjects = $this->model->getAll();
            $careers = $this->modelCareer->getAll();

            $this->view->showEdit($subject, $subjects, $careers);
        } else
            $this->index("You are not an administrator.");
    }

    public function add()
    {
        if (!AuthHelper::checkAdmin())
            return $this->index("You are not an administrator.");

        // is an admin so we check if there are all required data

        $subjectData = $_POST;
        $this->validateSubjectData($subjectData);

        // no errors so we can add the subject

        // if the subject has not a requirement we change the string to a null value por the database
        if ($subjectData['direct_requirement'] == "null")
            $subjectData['direct_requirement'] = null;


        // if the image is not empty
        if (isset($_FILES['input_image'])) {
            if (!$this->isImageTypeValid($_FILES['input_image']['type']))
                return $this->index(null, "The image type is not valid.");

            $tempImageFile = $_FILES['input_image']['tmp_name'];
            $tempImageName = $_FILES['input_image']['name'];
            $this->model->add($subjectData, $tempImageFile, $this->getNewUniqueImagePath($tempImageName));
        } else
            $this->model->add($subjectData);

        return $this->index(null, "The subject has been created.");
    }

    public function delete($params)
    {
        if (AuthHelper::checkAdmin()) {
            $subjectId = $params[':ID'];

            $subjectData = $this->model->get($subjectId);

            if (empty($subjectData))
                return $this->index("The subject does not exist.");

            if (isset($subjectData->image_path))
                if ($this->model->deleteImage($subjectData->image_path))

                    if ($this->model->delete($subjectId))
                        header("Location:" . BASE_URL . "subjects");
                    else
                        $this->index("This subjects cannot be delete 'cause is a requirement of another subject.");
        } else
            $this->index("You are not an administrator.");
    }

    public function update($params)
    {
        if (AuthHelper::checkAdmin()) {
            $subjectId = $params[':ID'];
            $subjectData = $_POST;
            $this->validateSubjectData($subjectData);

            if ($subjectData['direct_requirement'] == "null")
                $subjectData['direct_requirement'] = null;

            if (isset($_FILES['input_image'])) {
                if (!$this->isImageTypeValid($_FILES['input_image']['type']))
                    return $this->index(null, "The image type is not valid.");

                $tempImageFile = $_FILES['input_image']['tmp_name'];
                $tempImageName = $_FILES['input_image']['name'];
                $this->model->deleteImage($subjectData['image_path']);
                $this->model->update($subjectId, $subjectData, $tempImageFile, $this->getNewUniqueImagePath($tempImageName));
            } else
                $this->model->update($subjectId, $subjectData);
            $this->index();
        } else
            $this->index("You are not an administrator.");
    }

    private function getNewUniqueImagePath($imageName)
    {
        return 'assets/images/subjects/' . uniqid() . "." . strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    }

    private function isImageTypeValid($type)
    {
        return ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg');
    }

    private function validateSubjectData($subjectData)
    {
        $errors = [];

        if (empty($subjectData['semester']))
            $errors['semester'] = 'Semester input is not valid.';

        if (empty($subjectData['year']))
            $errors['year'] = 'Year input is not valid.';

        if (empty($subjectData['name']))
            $errors['name'] = 'Name input is not valid.';

        if (empty($subjectData['career']))
            $errors['career'] = 'Career input is not valid.';

        if (count($errors) > 0) {
            // print errors
            $errorsStrings = '';
            foreach ($errors as $error)
                $errorsStrings .= $error . '<br>';
            return $this->index($errorsStrings);
        }
    }
}
