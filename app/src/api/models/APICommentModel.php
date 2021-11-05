<?php
class APICommentModel
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

    function create($data)
    {
        $query = $this->db->prepare('INSERT INTO comment (subject_id, user_id, comment, difficulty) VALUES (?, ?, ?, ?);');
        $query->execute([$data->subject_id, $data->user_id, $data->comment, $data->difficulty]);
        return $this->db->lastInsertId();
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
