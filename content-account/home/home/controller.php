<?php
class controller extends main_controller
{
	public function config() 
	{
		// ----------------------------------------- account
		$this->listen(
		array(
			"domain" => "account"
			),
		array("account", 'home')
		);

		// ----------------------------------------- admin
		$this->listen(
		array(
			"domain" => "admin"
			),
		array("admin", 'home')
		);

		// ----------------------------------------- login
		$this->listen(
		array(
			"max" => 1,
			"url" => "login"
			),
		array("account", 'login')
		);

		// ----------------------------------------- logout
		$this->listen(
		array(
			"max" => 1,
			"url" => array("logout")
			),
		function()
		{
			session_unset(); 
			session_destroy();
			header("location: "."/");
			exit();
		}
		);
	}
}
?>