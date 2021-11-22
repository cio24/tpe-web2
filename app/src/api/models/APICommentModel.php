<?php
class APICommentModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getFilteredAndSorted($sortBy, $orderBy, $difficulty, $subjectId)
    {
        $query = $this->db->prepare("SELECT * FROM comment WHERE difficulty = :difficulty  AND subject_id = :subjectId ORDER BY $sortBy $orderBy");
        $query->bindParam(':difficulty', $difficulty);
        $query->bindParam(':subjectId', $subjectId);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    function getFilteredBySubject($subjectId)
    {
        $query = $this->db->prepare('SELECT * FROM comment where subject_id = ?;');
        $query->execute([$subjectId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function getSorted($sortBy, $orderBy, $subjectId)
    {
        $query = $this->db->prepare("SELECT * FROM comment WHERE subject_id = :subjectId ORDER BY $sortBy $orderBy");
        $query->bindParam(':subjectId', $subjectId);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getFiltered($filterByDifficulty, $subjectId)
    {
        $query = $this->db->prepare('SELECT * FROM comment WHERE difficulty = :filterByDifficulty AND subject_id = :subjectId');
        $query->bindParam(':filterByDifficulty', $filterByDifficulty);
        $query->bindParam(':subjectId', $subjectId);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    function create($data)
    {
        try {
            $query = $this->db->prepare('INSERT INTO comment (id, user_id, subject_id, comment, difficulty) VALUES (NULL, ?, ?, ?, ?);');
            $query->execute([$data['user_id'], $data['subject_id'], $data['comment'], $data['difficulty']]);
        } catch (PDOException $e) {
            return null;
        }
        return $this->db->lastInsertId();
    }

    function delete($id)
    {
        try {
            $query = $this->db->prepare('DELETE FROM comment WHERE id = ?;');
            $query->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
