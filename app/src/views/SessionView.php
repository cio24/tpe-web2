<?php

require_once './../vendor/autoload.php';

class SessionView {

    private $smarty;

   function __construct() {
       $this->smarty = new Smarty();
   } 

   function showLogin($errorMessage){
        $this->smarty->assign('admin', AuthHelper::checkAdmin());
        $action = AuthHelper::checkLoggedIn() ? 'out' : 'in';
        $this->smarty->assign('action', $action);
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/signInPage.tpl'); 
    }

}
