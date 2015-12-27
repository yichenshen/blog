<?php

/**
 * Class Login
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Login extends Controller {

    function __construct (){
        parent::__construct();
        require_once APP . 'model/user.php';
        $this->model = new User($this->db);
    }

    public function index(){
        require APP . 'view/_templates/header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/_templates/footer.php';  	
    }

    public function auth(){
    	$user = $_POST["username"];
        $pass = $_POST["password"];

        if($this->model->authenticate($user, $pass)){

        } else{

        }
    }
}
