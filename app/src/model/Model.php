<?php
class Model
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=tpeweb2-data', 'root', '');
    }
    function getData()
    {
        $query=$this->db->prepare('SELECT `career`.*, `subject`.* FROM `career` LEFT JOIN `subject` ON `subject`.`career` = `career`.`id`');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}
