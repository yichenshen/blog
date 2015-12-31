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

}
