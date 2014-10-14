<?php
class controller extends main_controller
{
	public function config() 
	{
		// ----------------------------------------- login
		$this->listen(
		array(
			"max" => 1,
			"url" => "signup"
			),
		array("accounts", 'signup')
		);
		$this->listen(
		array(
			"max" => 1,
			"url" => "delete"
			),
		array("accounts", 'signup', "mod" => "delete")
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
			header("location: "."/aaa");
			exit();
		}
		);
	}
}
?>