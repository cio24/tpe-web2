<?php
class SubjectModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function search($criteria)
    {
        $partialQuery = "SELECT s.*, c.name AS career FROM subject s JOIN career c ON s.career = c.id WHERE";
        // iterate through the criteria and add them to the query
        foreach ($criteria as $key => $value){
            if(empty($value))
                continue;
            $key = str_replace('_', '.', $key);
            $partialQuery .= " $key LIKE '%$value%' AND";
        }

        // remove the last AND
        $partialQuery = substr($partialQuery, 0, -3);
        print_r($partialQuery);

        $query = $this->db->prepare($partialQuery);
        foreach ($criteria as $key => $value)
            $query->bindValue(":$key", $value);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSubjectsCount()
    {
        $query = "SELECT COUNT(*) FROM subject";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    function getAll($offset, $limit)
    {
        $query = $this->db->prepare('SELECT s.*, c.name AS career FROM subject s JOIN career c ON s.career = c.id LIMIT :LIMIT OFFSET :OFFSET');
        $query->bindParam(':LIMIT', $limit, PDO::PARAM_INT);
        $query->bindParam(':OFFSET', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
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
        $subjectData = $query->fetch(PDO::FETCH_OBJ);
        return $subjectData;
    }

    function add($subject, $tempImageFile = null, $imagePath = null)
    {
        if (!empty($tempImageFile))
            $this->saveImage($tempImageFile, $imagePath);

        $query = $this->db->prepare("INSERT INTO subject (semester, year, name, direct_requirement, career, image_path) VALUES (?, ?, ?, ?, ?, ?);");
        $query->execute([$subject['semester'], $subject['year'], $subject['name'], $subject['direct_requirement'], $subject['career'], $imagePath]);
    }

    function saveImage($tempImageFile, $tempImagePath)
    {
        move_uploaded_file($tempImageFile, $tempImagePath);
    }

    function update($subjectId, $subject, $tempImageFile = null, $imagePath = null)
    {
        if (!empty($tempImageFile))
            $this->saveImage($tempImageFile, $imagePath);

        $query = $this->db->prepare("UPDATE subject SET semester = ?,year = ?,name = ?,direct_requirement = ?, career = ?, image_path = ? WHERE subject.id = ?;");
        $query->execute([$subject['semester'], $subject['year'], $subject['name'], $subject['direct_requirement'], $subject['career'], $imagePath, $subjectId ]);
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

    function deleteImage($imagePath)
    {
        return unlink($imagePath);
    }
}
