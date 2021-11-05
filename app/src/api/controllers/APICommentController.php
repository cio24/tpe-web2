<?php

require_once '/var/www/app/src/api/controllers/APIController.php';
require_once '/var/www/app/src/api/models/APICommentModel.php';

class APICommentController extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new APICommentModel();
    }

    public function getFilteredBySubject($params = null)
    {
        $subjectId = $params[':ID'];
        $comments = $this->model->getFilteredByCareer($subjectId);
        if (!empty($comments))
            $this->view->response($comments, 200);
        else {
            $this->view->response("No se encontraron comentarios de la materia", 404);
        }
    }

    public function getAll($params = null)
    {
        $comments = $this->model->getAll();
        if (!empty($comments))
            $this->view->response($comments, 200);
        else {
            $this->view->response("No se encontraron comentarios", 404);
        }
    }
}
