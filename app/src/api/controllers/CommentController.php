<?php
require_once './../models/CommentModel.php';
require_once './../APIView.php';

class CommentController extends APIController
{


    public function __construct()
    {
        parent::__construct();
        $this->model = new CommentModel();
    }

    public function getFilteredBySubject($params = null)
    {
        $subjectId = $params[':ID'];
        $comments = $this->model->getFilteredByCareer($subjectId);
        if(!empty($comments))
            $this->view->response($comments,200);
        else{
            $this->view->response("No se encontraron comentarios de la materia", 404);
        }
    }

    public function getAll($params = null)
    {
        $comments = $this->model->getAll();
        if(!empty($comments))
            $this->view->response($comments,200);
        else{
            $this->view->response("No se encontraron comentarios", 404);
        }
    }

}
