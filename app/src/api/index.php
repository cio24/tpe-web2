<?php

require_once './../Router.php';
require_once './controllers/APICommentController.php';

$apiRouter = new Router();

$apiRouter->addRoute("comments", "GET", "APICommentController", "get");
$apiRouter->addRoute("comments", "POST", "APICommentController", "post");
$apiRouter->addRoute("comments/:ID", "DELETE", "APICommentController", "delete");


function removeSuffix($path) {
    $path = explode("/", $path);
    array_shift($path);
    array_shift($path);
    return implode("/", $path);
}

$apiRouter->route(removeSuffix($_SERVER['REQUEST_URI']), $_SERVER['REQUEST_METHOD']);

