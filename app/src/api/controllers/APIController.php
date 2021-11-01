<?php
require_once "./../APIView.php";

abstract class APIController
{
    protected $model;
    protected $view;
    private $data;

    public function __construct()
    {
        $this->view = new APIView();
        $this->data = file_get_contents("php://input");
    }

    function getData()
    {
        return json_decode($this->data);
    }
}
