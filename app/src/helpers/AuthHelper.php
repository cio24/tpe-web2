<?php

class AuthHelper
{

    static public $isLoggedIn = false;

    static private function startSession()
    {
        if (session_status() != PHP_SESSION_ACTIVE){
            session_start();
            print_r(session_status());
            print_r(PHP_SESSION_ACTIVE);

        }
    }
    
    static public function checkLoggedIn()
    {
        AuthHelper::startSession();
        if (!isset($_SESSION['USER_EMAIL'])) {
            // header("Location: " . LOGIN);
            // die();
            $isLoggedIn = true;
            var_dump(AuthHelper::$isLoggedIn);
            die();
        }
    }

    static public function saveSession($user)
    {
        AuthHelper::startSession();

        $_SESSION['USER_EMAIL'] = $user->email;
        print_r('SESSION SAVED!  ');
    }

    static public function logout()
    {
        AuthHelper::startSession();
        session_destroy();
    }
}
