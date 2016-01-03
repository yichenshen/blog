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

    /**
     * The number of posts to show on one page in the vistor view.
     */
    private $page_count = 10;

    /**
     * The number of posts to show in the admin page.
     */
    private $admin_page_count = 20;

    /**
     * The number of pages in the pagination bar shown before and after the current page.
     */
    private $admin_pagination_preview = 2;

    function __construct (){
        parent::__construct();
        
        require_once APP . 'model/post.php';
        $this->model = new Post($this->db);

        require_once APP . 'model/comment.php';
        $this->comments = new Comment($this->db);
    }

    /**
     * PAGE: page 1
     * A method wrapper to the first page of the blog
     */
    public function index() {
        $this->page(1);
    }

    /**
     * PAGE: posts display page
     * Display a page of blog posts.
     *
     * Can be accessed by anyone
     *
     * @param   int     $page   The page number to display
     */
    public function page($page) {
        $page = (int) $page;
        $total_pages = (int) ceil($this->model->count() / $this->page_count);

        if($page < 1 || $page > $total_pages){
            header('Location: ' . URL . 'error');
        }else{

            $posts = $this->model->list_paged($page, $this->page_count);


            require APP . 'view/_templates/header.php';
            require APP . 'view/posts/index.php';
            require APP . 'view/_templates/footer.php';
        }
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
        if(isset($_SESSION['user'])){

            $page = (int) $page;
            $total_pages = (int) ceil($this->model->count() / $this->admin_page_count);

            if($page < 1 || $page > $total_pages){
                header('Location: ' . URL . 'error');
            } else{

                //We set an array of pagination indices, with -1 as ellipsis
                $indices = array();

                //First index
                array_push($indices, 1);
                
                //Ellipsis if page number is larger enough
                if($page > $this->admin_pagination_preview + 2){
                    array_push($indices, -1);
                }

                //Previews before and after the page number
                for ($i = $page - $this->admin_pagination_preview; $i <= $page + $this->admin_pagination_preview; $i++) { 
                    if($i > 1 && $i < $total_pages){
                        array_push($indices, $i);
                    }
                }

                //Ellipsis if page number is small enough
                if($page + $this->admin_pagination_preview < $total_pages - 1){
                    array_push($indices, -1);
                }

                //Last page
                if($total_pages > 1){
                    array_push($indices, $total_pages);
                }

                $posts = $this->model->list_paged($page, $this->admin_page_count);
                
                require APP . 'view/_templates/header.php';
                require APP . 'view/posts/admin.php';
                require APP . 'view/_templates/footer.php';
            }   
        } else{
            header('Location: ' . URL . 'error/unauthorized');
        }
    }

    /**
     * PAGE: Blog post show page
     * Displays the blog post on it's own.
     * 
     * Does not require login.
     * 
     * Comments should be handled from this page.
     * 
     * @param   int     $id     The ID of the post to show.
     */
    public function show($id){
        $post = $this->model->get($id);
        $comments = $this->comments->forPost($id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/posts/show.php';
        require APP . 'view/_templates/footer.php';      
    }

    /**
     * PAGE: New post creation page.
     * The page that allows writers to create a new blog post.
     * 
     * Requires login.
     */
    public function newpost(){
        if(isset($_SESSION['user'])){
            require APP . 'view/_templates/header.php';
            require APP . 'view/posts/new.php';
            require APP . 'view/_templates/footer.php';  
        } else{
            header('Location: ' . URL . 'error/unauthorized');
        }
    }

    /**
     * POST: Blog post creation function.
     * The POST URL that directs a creation of a post tuple in the database.
     * 
     * TODO: Check that the data supplied is valid.
     *  
     * Requires login.
     */
    public function create(){
        if(isset($_SESSION['user'])){
            $title = $_POST['title'];
            $content = $_POST['content'];

            if($title === '' || $content === '' || $title === null || $content === null){
                $error = 'Invalid input! Make sure fields are filled!';

                require APP . 'view/_templates/header.php';
                require APP . 'view/posts/new.php';
                require APP . 'view/_templates/footer.php'; 
            } else {
                $this->model->create($title, $content, $_SESSION['user']);

                header("Location: ". URL . "posts");
            }
        } else{
            header('Location: ' . URL . 'error/unauthorized');
        }
    }

    /**
     * PAGE: The edit posts page.
     * Page where the post details are retrieved from the database, then displayed in a form to allow for edits.
     * 
     * Requires login.
     * 
     * @param   int     $id     The ID of the post to edit.
     */
    public function edit($id){
        
        if(isset($_SESSION['user'])){
            $post = $this->model->get($id);

            if($_SESSION['user'] === $post->user_username){
                require APP . 'view/_templates/header.php';
                require APP . 'view/posts/edit.php';
                require APP . 'view/_templates/footer.php';  
            } else{
                header('Location: ' . URL . 'error/owner');
                die();
            }
        } else{
            header('Location: ' . URL . 'error/unauthorized');
        }
    }

    /**
     * POST: Blog post editing function.
     * The POST function to update the blog post in the database.
     * 
     * Requires login.
     * 
     * @param   int     $id     The ID of the post to edit.
     */
    public function update($id){
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] === $this->model->getUser($id)){

                $title = $_POST['title'];
                $content = $_POST['content'];

                if($title === '' || $content === '' || $title === null || $content === null){
                    $error = 'Invalid input! Make sure fields are filled!';

                    $post = (object) array('title' => $title, 'content' => $content, 'post_id' => $id);

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/posts/edit.php';
                    require APP . 'view/_templates/footer.php'; 
                } else {


                    $this->model->edit($id, $title, $content);

                    header("Location: ". URL . "posts/show/" . $id);
                }
            } else{
                header('Location: ' . URL . 'error/owner');
                die();
            }
        } else{
            header('Location: ' . URL . 'error/unauthorized');
        }
    }

    /**
     * POST: Blog post deletion function.
     * The POST function to delete te blog post tuple from the database.
     * 
     * Requires login.
     *
     * @param   int     $id     The ID of the post to delete.
     */
    public function delete($id){
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] === $this->model->getUser($id)){
                $this->model->delete($id);

                header("Location: " . URL . "posts/admin/1");
            } else{
                header('Location: ' . URL . 'error/owner');
                die();
            }
        } else{
            header('Location: ' . URL . 'error/unauthorized');
        }
    }
}
