<?php
class SubjectModel
{
    private $db;

    function __construct()
    {

        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=careersPath-data', 'root', '');
    }
    function getAllSubjects()
    {
        $query = $this->db->prepare('SELECT a.id, a.name, a.year, a.semester, a.direct_requirement, b.name AS career FROM subject a LEFT JOIN career b ON a.career = b.id;');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    function getSubjects($careerId){
        $query = $this->db->prepare('SELECT * FROM subject WHERE career = ?;');
        $query->execute(array($careerId));
        $subjectsData = $query->fetchAll(PDO::FETCH_OBJ);
        return $subjectsData;
    }
}
