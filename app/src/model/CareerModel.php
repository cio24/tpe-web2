<?php
class CareerModel
{
    private $db;

    function __construct()
    {

        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=tpeweb2-data', 'root', '');
    }
    function getAllCareers()
    {
        $query = $this->db->prepare('SELECT * FROM career;');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    function get($careerId)
    {
        $query = $this->db->prepare('SELECT * FROM career WHERE id = ?;');
        $query->execute(array($careerId));
        $careerData = $query->fetchAll(PDO::FETCH_OBJ);
        return $careerData;
    }
}
