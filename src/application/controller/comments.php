<?php

/**
 * Class Comments
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Comments extends Controller {

	function __construct (){
        parent::__construct();
        require_once APP . 'model/comment.php';
        $this->model = new Comment($this->db);
    }

    /**
     * POST: Create
     * Function to create the new comment.
     *
     * @param	int		$id		The ID of the post to create the comment for.
     */
    function create($id){
    	$author = $_POST['name'];

    	//Check for empty author
    	if($author === ''){
    		$author = 'Anonymous';
    	}

    	$content = $_POST['content'];

    	$this->model->create($author, $content, $id);

    	header('Location: ' . URL . 'posts/show/' . $id);
    }

    /**
     * POST: Edit
     * The edit method for a comment.
     *
     * This method first checks if there is a logged in user whom the comment belongs to. If not, an appropriate error will be thrown.
     *
     * @param   int     $post_id        The ID of the post which the comment belongs to
     * @param   int     $comment_id     The ID if the comment
     */
    function edit($post_id, $comment_id){
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] === $this->model->getUser($comment_id)){
                $author = $_POST['name'];

                //Check for empty author
                if($author === ''){
                    $author = 'Anonymous';
                }

                $content = $_POST['content'];

                $this->model->edit($comment_id, $author, $content);

                header('Location: ' . URL . 'posts/show/' . $post_id);
            
            } else{
                header('Location: ' . URL . 'error/owner');
                die();
            }
        }else {
            header('Location: ' . URL . 'error/unauthorized');
        }
    }

    /**
     * POST: Delete
     * The delete method for a comment.
     *
     * This method first checks if there is a logged in user whom the comment belongs to. If not, an appropriate error will be thrown.
     *
     * @param   int     $post_id        The ID of the post which the comment belongs to
     * @param   int     $comment_id     The ID if the comment
     */
    function delete($post_id, $comment_id){
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] === $this->model->getUser($comment_id)){
                $
                $this->model->delete($comment_id);

                header('Location: ' . URL . 'posts/show/' . $post_id);
            
            } else{
                header('Location: ' . URL . 'error/owner');
                die();
            }
        }else {
            header('Location: ' . URL . 'error/unauthorized');
        }
    }    
}
