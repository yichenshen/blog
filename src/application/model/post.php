<?php

/**
 * Class Post
 * The model for blog posts. Allows for insertion, updating, deletion and querying of blog posts from the database.
 *
 */

class Post extends Model{
	
	/**
	 * Returns posts objects for the given page
	 *
     * @param   int     $page       The page number
     * @param   int     $page_count The number of posts on each page.
     */
	function list_paged($page, $page_count) {
        $sql = 'SELECT * FROM post ORDER BY create_time DESC LIMIT ' . $page_count . ' OFFSET ' . $page_count * ($page-1);
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

        $query->execute($parameters);
    }
}
