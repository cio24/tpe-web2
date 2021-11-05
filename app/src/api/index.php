<?php

require_once './../Router.php';
require_once './controllers/APICommentController.php';

$apiRouter = new Router();

$apiRouter->addRoute("comments", "GET", "APICommentController", "getAll");

function removeSuffix($path) {
    $path = explode("/", $path);
    array_shift($path);
    array_shift($path);
    return implode("/", $path);
}


$apiRouter->route(removeSuffix($_GET['resource']), $_SERVER['REQUEST_METHOD']);

