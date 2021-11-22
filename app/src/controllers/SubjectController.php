<?php
require_once './models/SubjectModel.php';
require_once './views/SubjectView.php';
require_once './helpers/AuthHelper.php';


class SubjectController
{
    private $model;
    private $modelCareer;
    private $view;
    private $homeView;
    private const MAX_SUBJECTS_PER_PAGE = 10;

    public function __construct()
    {

        $this->model = new SubjectModel();
        $this->view = new SubjectView();
        $this->homeView = new HomeView();
        $this->modelCareer = new CareerModel();
    }

    public function showSearcher($params = null, $message = '')
    {
        if (!AuthHelper::checkLoggedIn())
            return $this->view->showNotFoundPage();
        $this->view->showSubjectsSearcher(AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
    }

    public function search($params = null)
    {
        if(!AuthHelper::checkLoggedIn())
            return $this->view->showNotFoundPage();

        $criteria = $_POST;
        if (empty($criteria['s_name']) && empty($criteria['c_name']) && empty($criteria['s_year']) && empty($criteria['s_semester']))
            return $this->index(null, 'Yoy have to add a search criteria.');

        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $subjects = $this->model->search($criteria);
        $careersData = $this->modelCareer->getAll();
        $this->view->showSearchResult($subjects, $careersData, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin(), !empty($subjects));
    }

    public function index($params = null, $mesagge = '')
    {
        $limit = self::MAX_SUBJECTS_PER_PAGE;

        $maxPageNumber = ceil($this->model->getSubjectsCount() / $limit);

        $pageNumber = isset($params['pathParams'][':PAGE_NUMBER']) ? $params['pathParams'][':PAGE_NUMBER'] : 1;

        
        if ($pageNumber > $maxPageNumber || $pageNumber < 1)
            return $this->view->showNotFoundPage();

        $offset = ($pageNumber - 1) * $limit;

        $subjectsData = $this->model->getAll($offset, $limit);

        $careersData = $this->modelCareer->getAll();
        $this->view->showAll($subjectsData, $careersData, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin(), $mesagge, $pageNumber, $maxPageNumber);
    }

    public function show($params)
    {
        session_start();
        $userId = $_SESSION["USER_ID"];
        $subjectData = $this->model->get($params['pathParams'][':ID']);
        if (empty($subjectData))
            return $this->view->showNotFoundPage();
        $this->view->showSubject($subjectData, $userId, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
    }

    public function edit($params)
    {

        if (AuthHelper::checkAdmin()) {
            $subjectId = $params['pathParams'][':ID'];
            $subject = $this->model->get($subjectId);
            if (empty($subject))
                return $this->index(null, "The subject does not exist.");

            $subjects = $this->model->getAll(1, self::MAX_SUBJECTS_PER_PAGE);
            $careers = $this->modelCareer->getAll(1, self::MAX_SUBJECTS_PER_PAGE);

            $this->view->showEdit($subject, $subjects, $careers, AuthHelper::checkLoggedIn(), AuthHelper::checkAdmin());
        } else
            $this->index(null,"You are not an administrator.");
    }

    public function add($params = null)
    {
        if (!AuthHelper::checkAdmin())
            return $this->index(null,"You are not an administrator.");

        // is an admin so we check if there are all required data

        $subjectData = $_POST;
        $this->validateSubjectData($subjectData);

        // no errors so we can add the subject

        // if the image is not empty
        if ((!empty($_FILES['input_image']['name']))) {
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
            $subjectId = $params['pathParams'][':ID'];

            $subjectData = $this->model->get($subjectId);

            if (empty($subjectData))
                return $this->index(null,"The subject does not exist.");

            if (!empty($subjectData->image_path)){                    
                if (!$this->model->deleteImage($subjectData->image_path))
                    return $this->index(null,"The image of the subject could not be deleted.");
            }
            if ($this->model->delete($subjectId))
                $this->index(null,"The subject has been deleted.");
            else
                $this->index(null, "This subjects could not be deleted.");
        } else
            $this->index(null, "You are not an administrator.");
    }

    public function update($params)
    {
        if (AuthHelper::checkAdmin()) {
            $subjectId = $params['pathParams'][':ID'];
            $subjectData = $_POST;
            $this->validateSubjectData($subjectData);
            
            if (!empty($_FILES['input_image']['name'])) {
                if (!$this->isImageTypeValid($_FILES['input_image']['type']))
                    return $this->index(null, "The image type is not valid.");

                $tempImageFile = $_FILES['input_image']['tmp_name'];
                $tempImageName = $_FILES['input_image']['name'];
                $oldImagePath = $this->model->get($subjectId)->image_path;
                if(!empty($oldImagePath))
                    $this->model->deleteImage($oldImagePath);
                $this->model->update($subjectId, $subjectData, $tempImageFile, $this->getNewUniqueImagePath($tempImageName));
            } else
                $this->model->update($subjectId, $subjectData);

            $this->index(null, "Subject updated");
        } else
            $this->index(null,"You are not an administrator.");
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
            return $this->index(null,$errorsStrings);
        }
    }
}
