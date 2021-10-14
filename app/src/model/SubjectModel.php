<?php
class SubjectModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=tpeweb2-data', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function getAll()
    {
        $query = $this->db->prepare('SELECT a.id, a.name, a.year, a.semester, a.direct_requirement, b.name AS career FROM subject a LEFT JOIN career b ON a.career = b.id;');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    function getFilteredByCareer($careerId)
    {
        $query = $this->db->prepare('SELECT * FROM subject WHERE career = ?;');
        $query->execute(array($careerId));
        $subjectsData = $query->fetchAll(PDO::FETCH_OBJ);
        return $subjectsData;
    }

    function get($subjectId)
    {
        $query = $this->db->prepare('SELECT s.*, c.name as "careerName"  FROM subject s JOIN career c on s.career = c.id WHERE s.id = ?;');
        $query->execute(array($subjectId));
        $subjectData = $query->fetchAll(PDO::FETCH_OBJ);
        return $subjectData;
    }
    function add($subject)
    {
        try {
            //code...
            $query = $this->db->prepare("INSERT INTO `subject` (`id`, `semester`, `year`, `name`, `direct_requirement`, `career`) VALUES (NULL, ?, ?, ?, ?, ?);");
            $query->execute(array($subject['semester'], $subject['year'], $subject['name'], $subject['direct_requirement'], $subject['career']));
        } catch (PDOException $s) {
            print_r($s);
        }
        var_dump($subject);
    }
    function update($subjectId,$subject)
    {
        $query = $this->db->prepare("UPDATE `subject` SET `semester` = ?,`year` = ?,`name` = ?,`direct_requirement` = ?, `career` = ? WHERE `subject`.`id` = ?;");
        $query->execute(array($subject['semester'], $subject['year'], $subject['name'], $subject['direct_requirement'], $subject['career'], $subjectId));
    }
    function delete($subjectId)
    {
        $query = $this->db->prepare("DELETE FROM `subject` WHERE `subject`.`id` = ?");
        $query->execute(array($subjectId));
    }
}
