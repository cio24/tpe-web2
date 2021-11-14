<?php
class SubjectModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function getAll()
    {
        $query = $this->db->prepare('SELECT s.*, c.name AS career FROM subject s JOIN career c ON s.career = c.id;');
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

    function add($subject, $tempImageFile = null, $imagePath = null)
    {
        if (!empty($tempImageFile))
            move_uploaded_file($tempImageFile, $imagePath);

        $query = $this->db->prepare("INSERT INTO subject (semester, year, name, direct_requirement, career, image_path) VALUES (?, ?, ?, ?, ?, ?);");
        $query->execute([$subject['semester'], $subject['year'], $subject['name'], $subject['direct_requirement'], $subject['career'], $imagePath]);
    }

    function saveImage($tempImageFile, $tempImagePath)
    {
        move_uploaded_file($tempImageFile, $tempImagePath);
    }

    function update($subjectId, $subject)
    {
        if ($subject['direct_requirement'] == "null")
            $subject['direct_requirement'] = null;
        $query = $this->db->prepare("UPDATE subject SET semester = ?,year = ?,name = ?,direct_requirement = ?, career = ? WHERE subject.id = ?;");
        $query->execute(array($subject['semester'], $subject['year'], $subject['name'], $subject['direct_requirement'], $subject['career'], $subjectId));
    }
    function delete($subjectId)
    {
        try {
            $query = $this->db->prepare("DELETE FROM subject WHERE id = ?");
            $query->execute(array($subjectId));
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
