<?php

/**
 * Class User
 * The model for users.
 *
 */

class User extends Model{

	function authenticate($username, $password){
		$sql = "SELECT password FROM user WHERE username = :user";
		$query = $this->db->prepare($sql);
		$parameters = array(':user' => $username);

		$query->execute($parameters);

		$result = $query->fetch();

		if ($result && $result->password === sha1($password)){
			return true;
		} else{
			return false;
		}
	}
}
