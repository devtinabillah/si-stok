<?php 

class Login_model extends CI_Model {

	public function login($username, $password) {
		return $this->db->like([
			'username' => $username,
			'password' => $password
		])->get('user')->result_array();
	}
}

?>