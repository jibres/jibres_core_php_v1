<?php
class controller extends main_controller
{
	public function config() 
	{
		// ----------------------------------------- accounts
		$this->listen(
		array(
			"domain" => "admin"
			),
		array("admin", 'home')
		);

		// ----------------------------------------- signup
		$this->listen(
		array(
			"max" => 1,
			"url" => "signup"
			),
		array("accounts", 'signup')
		);

		// ----------------------------------------- recovery
		$this->listen(
		array(
			"max" => 1,
			"url" => "recovery"
			),
		array("accounts", 'recovery')
		);

		// ----------------------------------------- login
		$this->listen(
		array(
			"max" => 1,
			"url" => "login"
			),
		array("accounts", 'login')
		);

		// ----------------------------------------- logout
		$this->listen(
		array(
			"max" => 1,
			"url" => array("logout")
			),
		function()
		{
			$_SESSION = array();
			session_destroy();
			header("location: "."/");
			exit();
		}
		);
	}
}
?>