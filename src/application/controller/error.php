<?php

/**
 * Class Error
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Error extends Controller
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/error/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: unauthorized
     * This method handles the error page for unauthorized access.
     */
    public function unauthorized(){
        if(isset($_SESSION['user'])){
            header('Location: ' . URL);
        } else{
            require APP . 'view/_templates/header.php';
            require APP . 'view/error/unauthorized.php';
            require APP . 'view/_templates/footer.php';   
        }
    }

    /**
     * PAGE: Owner permission eror
     * This method handles the error page whereby an user tries to modify content that's not his.
     */
    public function owner(){

        require APP . 'view/_templates/header.php';
        require APP . 'view/error/owner.php';
        require APP . 'view/_templates/footer.php';   
    }
}
