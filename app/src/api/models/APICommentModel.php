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

    function getFilteredByUser($userId)
    {
        $query = $this->db->prepare('SELECT * FROM comment where id_user = ?;');
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM comment;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function get($id)
    {
        $query = $this->db->prepare('SELECT * FROM comment where id = ?;');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getByUserAndSubject($userId, $subjectId)
    {
        $query = $this->db->prepare('SELECT * FROM comment where user_id = ? and subject_id = ?;');
        $query->execute([$userId, $subjectId]);
        return $query->fetch(PDO::FETCH_OBJ);
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
