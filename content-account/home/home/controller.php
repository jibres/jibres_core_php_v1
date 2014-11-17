<?php
class controller extends main_controller
{
	public function config() 
	{

		// ----------------------------------------- login
		$this->listen(
		array(
				"max" => 1,
			),
			function()
			{
				/**
				@Javad: if user login to system redirect to home
				 */
				header("location: "."/login");
				// header("location: http://".DOMAIN);
				exit();
			}
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
