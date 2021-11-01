<?php

class AuthHelper
{
    static public function checkLoggedIn()
    {
        session_start();
        return isset($_SESSION['USER_ID']);
    }

    static public function saveSession($user)
    {
        session_start();
        $_SESSION['USER_ID'] = $user->email;
        $_SESSION['USER_PERMISSION'] = $user->permission;
    }
}
