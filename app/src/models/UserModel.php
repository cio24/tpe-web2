<?php
class UserModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=mysql-tpeweb2-c;port=3306;dbname=db-tpe-web2', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function get($id)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE id = ?;');
        $query->execute(array($id));
        $userData = $query->fetch(PDO::FETCH_OBJ);
        return $userData;
    }

    function getAllWithout($userId)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE id != ?;');
        $query->execute([($userId)]);
        $usersData = $query->fetchAll(PDO::FETCH_OBJ);
        return $usersData;
    }

    function getByEmail($email)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE email = ?;');
        $query->execute(array($email));
        $userData = $query->fetch(PDO::FETCH_OBJ);
        return $userData;
    }

    function add($user)
    {
        $query = $this->db->prepare("INSERT INTO user (id, email, password, permission) VALUES (NULL, ?, ?, ?);");
        $query->execute(array($user['email'], $user['password'], $user['permission']));
    }
    function delete($userId)
    {
        $query = $this->db->prepare("DELETE FROM user WHERE id = ?");
        $query->execute(array($userId));
    }
    function update($userId, $userData)
    {
        $query = $this->db->prepare("UPDATE user SET permission = ? WHERE user.id = ?;");
        $query->execute(array($userData['permission'], $userId));
    }
}
