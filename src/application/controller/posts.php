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
     * PAGE: page 1
     * A method wrapper to the first page of the blog
     */
    public function index() {
        $this->page(1);
    }

    //TODO add paging

    /**
     * PAGE: posts display page
     * Display a page of blog posts.
     *
     * Can be accessed by anyone
     *
     * @param   int     $page   The page number to display
     */
    public function page($page) {
        $posts = $this->model->all();

        require APP . 'view/_templates/header.php';
        require APP . 'view/posts/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: Posts admin page
     * Displays the admin page, or the dashboard
     *
     * Requires login.
     *
     * @param   int     $page   The page number to display
     */
    public function admin($page) {
        $posts = $this->model->all();
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/posts/admin.php';
        require APP . 'view/_templates/footer.php';   
    }

    public function show($id){
        $post = $this->model->get($id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/posts/show.php';
        require APP . 'view/_templates/footer.php';      
    }

    public function newpost(){
        require APP . 'view/_templates/header.php';
        require APP . 'view/posts/new.php';
        require APP . 'view/_templates/footer.php';  
    }

    public function create(){
        $title = $_POST['title'];
        $content = $_POST['content'];

        $this->model->create($title, $content);
    }

}
