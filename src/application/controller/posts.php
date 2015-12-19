<?php

/**
 * Class Posts
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Posts extends Controller {

    function __construct (){
        parent::__construct();
        require_once APP . 'model/post.php';
        $this->model = new Post($this->db);
    }

    /**
     * PAGE: index
     * 
     */
    public function index() {
        $posts = $this->model->all();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/posts/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
