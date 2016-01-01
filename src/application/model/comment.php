<?php

/**
 * Class Comment
 * The model for comments. Allows for insertion, updating, deletion and querying of comments from the database.
 *
 */

class Comment extends Model{

	/**
	 * Retrives all the comments for a certain post.
	 *
	 * Comments are returned in reverse chronological order.
	 *
	 * @param	int		$id		The ID of the post.
	 */
	function forPost($id){
		$sql = 'SELECT * FROM comment WHERE post_id = :id ORDER BY create_time DESC';
		$query = $this->db->prepare($sql);
		$parameters = array(':id' => $id);

		$query->execute($parameters); 

		return $query->fetchAll();
	}

	/**
	 * Gets the user for the comment.
	 *
	 * @param 	int 	$id		The ID of the comment.
	 */
	function getUser($id){
		$sql  = "SELECT user_username FROM comment WHERE comments_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetch()->user_username;

	}

	/**
	 * Creates a new comment for a certain post.
	 *
	 * If a username is provided, the comment will be linked to a certain user. The user may then edit or delete the comment.
	 * 
	 * @param	string	$author		The author's name
	 * @param	string 	$content	The comment content
	 * @param	string 	$post_id	The post the comment is for
	 * @param	string 	$username	The user the comment should be linked to. 
	 */
	function create($author, $content, $post_id, $username = null){
		$sql = 'INSERT INTO comment (author_name, content, post_id, user_username) VALUES (:author, :content, :post_id, :user)';
		$query = $this->db->prepare($sql);
		$parameters = array(':author' => $author, ':content' => $content, ':post_id' => $post_id, ':user' => $username);
		
		$query->execute($parameters);
	}

	/**
	 * Changes the author and content of a given comment.
	 * 
	 * @param	int 	$id			The ID of the comment to edit
	 * @param	string	$author		The new author's name for the comment
	 * @param	string	$content	The new content for the comment
	 */
	function edit($id, $author, $content){
		$sql = 'UPDATE comment SET author_name = :author, content = :content, update_time = now() WHERE comments_id = :id';
		$query = $this->db->prepare($sql);
		$parameters = array(':author' => $author, ':content' => $content, ':id' => $id);

		$query->execute($parameters);
	}

	/**
     * Deletes the comment.
     * 
     * @param	int		$id			The ID of the comment to delete.
     */
    function delete($id){
    	$sql = 'DELETE FROM comment WHERE comments_id = :id';
    	$query = $this->db->prepare($sql);
    	$parameters = array(':id' => $id);

        $query->execute($parameters);
    }

}
	