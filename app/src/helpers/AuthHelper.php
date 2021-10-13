<?php

class AuthHelper
{   
    static public function checkLoggedIn()
    {
        session_start();
        return isset($_SESSION['USER_EMAIL']);
    }

    static public function saveSession($user)
    {
        session_start();
        $_SESSION['USER_EMAIL'] = $user->email;
    }

    static public function logout()
    {
        session_start();
        session_destroy();
    }
}
