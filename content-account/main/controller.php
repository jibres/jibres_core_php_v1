<?php

class main_controller extends mvcController_cls
{
	function config()
	{
		// ----------------------------------------- logout
		$this->listen(
			array(
				"url" => array("account", "logout")
				),
			function()
			{
				session_unset(); 
				session_destroy();
				header("location: http://".URL_RAW);
				debug_lib::true("Logout successfully");
				exit();
			}
			);

		// ----------------------------------------- Redirect home to login
		// if user login only allow access to verification
		// else if user method is home redirect to login
		if($this->login())
		{
			if(config_lib::$method!='verification')
			{
				debug_lib::true("You are loggined to system!");
				header("Location: http://".URL_RAW);
				exit();
			}
		}
		else
		{			
			if(config_lib::$method=='home')
			{
				header("Location: /login");
				exit();
			}
		}
	}
}
?>
