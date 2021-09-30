<?php
class Model
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=tpeweb2careerspath.loc:port=3306;dbname=db-tpe-web2;charset=utf8', 'root', '');
    }
    function getData()
    {
        $query=$this->db->prepare('SELECT `career`.*, `subject`.* FROM `career` LEFT JOIN `subject` ON `subject`.`career` = `career`.`id`');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}
