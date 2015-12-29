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


    /**
     * PAGE: Login page
     * Displays the login page for writers to login.
     *
     * Will redirect to dashboard (admin) if user is already logged in.
     *
     * @param   int     $page   The page number to display
     */
    public function index(){
        if(isset($_SESSION['user'])){
            header("Location: ". URL . "posts/admin/1");
        } else { //Only render if not logged in
            require APP . 'view/_templates/header.php';
            require APP . 'view/login/index.php';
            require APP . 'view/_templates/footer.php';  	
        }
    }

    /**
     * POST: authentication
     * Authenticates, the user based on credentials from the database.
     * 
     * If authentication is successful, the session variable is set and the user is redirected to the dashboard (admin).
     * 
     * If not, an error message will be set and the the login page re-rendered to show the error.
     */
    public function auth(){
    	$user = $_POST["username"];
        $pass = $_POST["password"];

        if($this->model->authenticate($user, $pass)){
            $_SESSION['user'] = $user;
            header("Location: ". URL . "posts/admin/1");
        } else{
            $error = "Invalid Username and/or Password!";

            require APP . 'view/_templates/header.php';
            require APP . 'view/login/index.php';
            require APP . 'view/_templates/footer.php';     
        }
    }

    /**
     * POST: logout
     * Logs the user out, destroy and session variables and redirect to main page.
     */
    public function logout(){
        session_unset();
        session_destroy();

        header('Location: ' . URL . 'posts');
        die();
    }
}
