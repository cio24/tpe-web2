<?php

class AuthHelper
{
    static public function checkLoggedIn()
    {
        session_start();
        if (!isset($_SESSION['USER_EMAIL'])) {
            header("Location: " . LOGIN);
            die();
        }
    }

    static public function startSession($user)
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
