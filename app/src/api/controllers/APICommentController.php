<?php

require_once '/var/www/app/src/api/controllers/APIController.php';
require_once '/var/www/app/src/api/models/APICommentModel.php';
require_once '/var/www/app/src/helpers/AuthHelper.php';

class APICommentController extends APIController
{

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

    public function get($params = null)
    {
        $comments = $this->model->getAll();
        if (!empty($comments))
            $this->view->response($comments, 200);
        else {
            $this->view->response("No se encontraron comentarios", 404);
        }
    }

    public function post($params = null)
    {
        $data = $this->getData();
        $comment = $this->model->getByUserAndSubject($data['subject_id'], $data['user_id']);
        print_r($comment);
        if (!empty($comment)) {
            $this->view->response("El ususario ya ha comentado esta materia", 409);
        } else {
            $commentId = $this->model->create($data);
            if (!empty($commentId))
                $this->view->response($commentId, 201);
            else {
                $this->view->response("No se pudo crear el comentario", 500);
            }
        }
    }

    public function delete($params = null)
    {
        if (AuthHelper::checkAdmin()) {
            $commentId = $params[':ID'];
            if ($this->model->get($commentId)) {
                if ($this->model->delete($commentId))
                    $this->view->response("Comentario eliminado", 200);
                else
                    $this->view->response("No se pudo eliminar el comentario", 500);
            } else {
                $this->view->response("No se encontró el comentario", 404);
            }
        } else
            $this->view->response("El usuario no esta logeado o no tiene permisos para eliminar comentarios", 401);
    }
}
