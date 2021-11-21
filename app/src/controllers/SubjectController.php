<?php
require_once './models/SubjectModel.php';
require_once './views/SubjectView.php';
require_once './helpers/AuthHelper.php';


class SubjectController
{
    private $model;
    private $modelCareer;
    private $view;
    private const MAX_SUBJECTS_PER_PAGE = 10;

    public function __construct()
    {

        $this->model = new SubjectModel();
        $this->view = new SubjectView();
        $this->modelCareer = new CareerModel();
    }

    public function showSearcher($params = null, $message = '')
    {
        $this->view->showSubjectsSearcher();
    }

    public function search($params = null)
    {
        $criteria = $_POST;
        if (empty($criteria['s_name']) && empty($criteria['c_name']) && empty($criteria['s_year']) && empty($criteria['s_semester']))
            return $this->index(null, 'Yoy have to add a search criteria.');

        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $subjects = $this->model->search($criteria);
        $careersData = $this->modelCareer->getAll();
        $this->view->showSearchResult($subjects, $action, $careersData);
    }

    public function index($params = null, $mesagge = '')
    {
        $limit = self::MAX_SUBJECTS_PER_PAGE;

        $maxPageNumber = ceil($this->model->getSubjectsCount() / $limit);

        $pageNumber = $params[':PAGE_NUMBER'];
        if (empty($pageNumber))
            $pageNumber = 1;
        elseif ($pageNumber > $maxPageNumber)
            $pageNumber = $maxPageNumber;
        $offset = ($pageNumber - 1) * $limit;

        $subjectsData = $this->model->getAll($offset, $limit);

        $careersData = $this->modelCareer->getAll();
        $this->view->showAll($subjectsData, $careersData, AuthHelper::checkAdmin(), $mesagge, $pageNumber, $maxPageNumber);
    }

    public function show($params)
    {
        session_start();
        $userId = $_SESSION["USER_ID"];
        $subjectData = $this->model->get($params[':ID']);
        $this->view->showSubject($subjectData, $userId, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
    }

    public function edit($params)
    {

        if (AuthHelper::checkAdmin()) {
            $subjectId = $params[':ID'];
            $subject = $this->model->get($subjectId);
            if (empty($subject))
                return $this->index(null, "The subject does not exist.");

            $subjects = $this->model->getAll(1, self::MAX_SUBJECTS_PER_PAGE);
            $careers = $this->modelCareer->getAll(1, self::MAX_SUBJECTS_PER_PAGE);

            $this->view->showEdit($subject, $subjects, $careers);
        } else
            $this->index("You are not an administrator.");
    }

    public function add($params = null)
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

            if (!empty($subjectData->image_path))
                if ($this->model->deleteImage($subjectData->image_path))

                    if ($this->model->delete($subjectId))
                        header("Location:" . BASE_URL . "subjects");
                    else
                        $this->index("This subjects cannot be delete 'cause is a requirement of another subject.");
        } else
            $this->index(null, "You are not an administrator.");
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
                $this->model->deleteImage($this->model->get($subjectId)->image_path);
                $this->model->update($subjectId, $subjectData, $tempImageFile, $this->getNewUniqueImagePath($tempImageName));
            } else
                $this->model->update($subjectId, $subjectData);

            $this->index(null, "Subject updated");
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
            $errorsStrings = '';
            foreach ($errors as $error)
                $errorsStrings .= $error . '<br>';
            return $this->index($errorsStrings);
        }
    }
}
