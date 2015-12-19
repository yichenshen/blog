<?php

/**
 * Class Post
 * The controller for post objects. Provides methods to list, create, edit and delete blog posts.
 *
 */

class Post extends Model{
	
	function all() {
        $sql = "SELECT title, content, user_username as 'author' FROM post";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
