<?php
class CareerModel
{
    private $db;

    function __construct()
    {

        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
    }
    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM career;');
        $query->execute();
        $careersData = $query->fetchAll(PDO::FETCH_OBJ);
        return $careersData;
    }

    function get($careerId)
    {
        $query = $this->db->prepare('SELECT * FROM career WHERE id = ?;');
        $query->execute(array($careerId));
        $careerData = $query->fetch(PDO::FETCH_OBJ);
        return $careerData;
    }
    function add($career)
    {
        $query = $this->db->prepare("INSERT INTO career (id, name, years, faculty) VALUES (NULL, ?, ?, ?);");
        $query->execute(array($career['name'], $career['years'], $career['faculty']));
    }

    function update($careerId,$career)
    {
        $query = $this->db->prepare("UPDATE career SET name = ?, years = ?, faculty = ? WHERE career.id = ?;");
        $query->execute(array($career['name'], $career['years'], $career['faculty'], $careerId));
    }
    function delete($careerId)
    {
        $query = $this->db->prepare("DELETE FROM career WHERE career.id = ?");
        $query->execute(array($careerId));
    }
}
