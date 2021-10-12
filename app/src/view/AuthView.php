<?php

require_once './../vendor/autoload.php';

class AuthView {

    private $smarty;

   function __construct() {
       $this->smarty = new Smarty();
   } 

   function showLogin($errorMessage){
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('templates/login.tpl'); 
    }

}
