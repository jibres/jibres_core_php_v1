<?php
class controller extends main_controller
{
	public function config() 
	{
		// ----------------------------------------- login
		$this->listen(
			array(
				"max" => 1,
				"url" => "login"
			),
			function()
			{
				header("location: http://account.".URL_RAW."/login");
				exit();
			}
		);

		// ----------------------------------------- logout
		$this->listen(
			array(
				"max" => 1,
				"url" => "logout"
			),
			function()
			{
				header("location: http://account.".URL_RAW."/logout");
				exit();
			}
		);
		
		// ----------------------------------------- signup
		$this->listen(
			array(
				"max" => 1,
				"url" => "signup"
			),
			function()
			{
				header("location: http://account.".URL_RAW."/signup");
				exit();
			}
		);
	}
}
?>