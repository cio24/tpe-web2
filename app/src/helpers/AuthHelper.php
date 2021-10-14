<?php

class AuthHelper
{
    static public function checkLoggedIn()
    {
        session_start();
        return isset($_SESSION['USER_ID']);
    }

    static public function saveSession($userId)
    {
        session_start();
        $_SESSION['USER_ID'] = $userId;
    }
}
