<?php
class UserModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=careersPath-data', 'root', '');
    }

    function getAllCareers()
    {
        $query = $this->db->prepare('SELECT * FROM career;');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    function get($email)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE email = ?;');
        $query->execute(array($email));
        $userData = $query->fetchAll(PDO::FETCH_OBJ);
        return $userData;
    }
}
