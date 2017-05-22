<?php
class Login_model extends CI_Model {

	var $id = '';
	var $login = '';
	var $mdp = '';

	function Login_model() {
		// Call the Model constructor
		parent::__construct();
	}

	function identification() {
		$sql = "SELECT id, login, mdp FROM login WHERE login LIKE '" . $_POST['login'] . "' AND mdp LIKE '" . $_POST['password'] . "'";

		return $this -> db -> query($sql)->row();
	}
}
