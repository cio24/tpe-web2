<?php
class CommentModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function getFilteredBySubject($subjectId)
    {
        $query = $this->db->prepare('SELECT * FROM comment where id_subject = ?;');
        $query->execute([$subjectId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM comment;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function add($commentData)
    {
        $query = $this->db->prepare("INSERT INTO comment (subject_id, user_id, comment, difficulty) VALUES (NULL, ?, ?, ?, ?);");
        $query->execute(array($commentData['subjectId'], $commentData['userId'], $commentData['comment'], $commentData['difficulty']));
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
