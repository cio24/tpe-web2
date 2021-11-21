<?php

require_once '/var/www/app/src/api/controllers/APIController.php';
require_once '/var/www/app/src/api/models/APICommentModel.php';

class APICommentController extends APIController
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new APICommentModel();
    }

    public function getFilteredBySubject($params = null)
    {
        $subjectId = $params['pathParams'][':ID'];
        $comments = $this->model->getFilteredByCareer($subjectId);
        if (!empty($comments))
            $this->view->response($comments, 200);
        else {
            $this->view->response("No comments found.", 404);
        }
    }

    public function get($params = null)
    {
        $queryParams = $params['queryParams'];

        if(!$this->areParamsValid($queryParams))
            return $this->view->response("Invalid parameters.", 400);

        if(isset($queryParams['sortBy']) && isset($queryParams['orderBy']) && isset($queryParams['filterByDifficulty']))
            $comments = $this->model->getFilteredAndSorted($queryParams['sortBy'], $queryParams['orderBy'],$queryParams['filterByDifficulty']);
        elseif (isset($queryParams['sortBy']) && isset($queryParams['orderBy']))
            $comments = $this->model->getSorted($queryParams['sortBy'], $queryParams['orderBy']);
        elseif (isset($queryParams['filterByDifficulty']))
            $comments = $this->model->getFiltered($queryParams['filterByDifficulty']);
        else
            $comments = $this->model->getAll();
        
        if (!empty($comments))
            $this->view->response($comments, 200);
        else {
            $this->view->response("No comments found.", 404);
        }
    }

    private function areParamsValid($queryParams){
        if (isset($queryParams['sortBy']) && !in_array($queryParams['sortBy'], ['difficulty', 'id']))
            return false;
        if (isset($queryParams['orderBy']) && !in_array($queryParams['orderBy'], ['asc', 'desc']))
            return false;
        if (isset($queryParams['filterByDifficulty']) && !in_array($queryParams['filterByDifficulty'], [1,2,3,4,5]))
            return false;
        return true;
    }


    public function post($params = null)
    {
        $data = $this->getData();
        $comment = $this->model->getByUserAndSubject($data['subject_id'], $data['user_id']);
        if (!empty($comment)) {
            $this->view->response("The user has already commented this subject.", 409);
        } else {
            $commentId = $this->model->create($data);
            if (!empty($commentId))
                $this->view->response($commentId, 201);
            else {
                $this->view->response("No comments found.", 500);
            }
        }
    }

    public function delete($params = null)
    {
        $commentId = $params['pathParams'][':ID'];
        if ($this->model->get($commentId)) {
            if ($this->model->delete($commentId))
                $this->view->response("Comment deleted.", 200);
            else
                $this->view->response("The comment could not be deleted.", 500);
        } else {
            $this->view->response("No comments found.", 404);
        }
    }
}
