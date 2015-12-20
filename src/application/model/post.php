<?php

/**
 * Class Post
 * The controller for post objects. Provides methods to list, create, edit and delete blog posts.
 *
 */

class Post extends Model{
	
	/**
	 * Returns all the posts objects
	 */
	function all() {
        $sql = "SELECT * FROM post ORDER BY create_time DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Returns a single blog post object, by ID.
     *
     * @param	int		$id			The ID of the blog post to return.
     */
    function get($id){
    	$sql  = "SELECT * FROM post WHERE post_id = :id";
		$query = $this->db->prepare($sql);
    	$parameters = array(':id' => $id);

    	$query->execute($parameters);

    	return $query->fetch();
    }

    /**
     * Creates a new blog post in the database, together with content.
     * 
     * The author of the post is assigned based on login.
     *
     * @param	string	$title		The title of the blog post
     * @param	string	$content	The content of the blog post 
     */
    function create($title, $content){
		$sql = "INSERT INTO post (title, content, user_username) VALUES (:title, :content, :author)";
        $query = $this->db->prepare($sql);
        $parameters = array(':title' => $title, ':content' => $content, ':author' => "admin"); //TODO: replace with loggedInUser
    
    	$query->execute($parameters);
    }

    /**
     * Edit the title and contents of a blog post.
	 *
     * @param	int		$id			The ID of the blog post to edit
     * @param	string	$title		The title of the blog post
     * @param	string	$content	The content of the blog post 
     */
    function edit($id, $title, $content){
		$sql = "UPDATE post SET title = :title, content = :content, update_time = now() WHERE post_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':title' => $title, ':content' => $content);

        $query->execute($parameters);
    }

    /**
     * Deletes the blog post.
     * 
     * @param	int		$id			The ID of the blog post to delete.
     */
    function delete($id){
    	$sql = "DELETE FROM post WHERE post_id = :id";
    	$query = $this->db->prepare($sql);
    	$parameters = array(':id' => $id);
    }
}
