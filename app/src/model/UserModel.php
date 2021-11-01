<?php
class UserModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
    }

    function get($email)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE email = ?;');
        $query->execute(array($email));
        $userData = $query->fetch(PDO::FETCH_OBJ);
        return $userData;
    }

    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM user;');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    function add($user)
    {
        $query = $this->db->prepare("INSERT INTO user (email, password) VALUES (?, ?);");
        $query->execute(array($user['email'], $user['password']));
    }
}
