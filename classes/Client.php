<?php
class Client {
	private $user;
	private $database;

	public function __construct($database, $user){
		$this->database = $database;
		$user_details_query = mysqli_query($this->database, "SELECT * FROM users WHERE username='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	}
?>
