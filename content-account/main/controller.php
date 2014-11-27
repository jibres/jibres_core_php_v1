<?php
class main_controller extends mvcController_cls
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

	function options()
	{
		if($this->login())
		{
			//redirect to cp
			// var_dump('user login to system: redirect to cp');
			// $this->redirect->urlChange()->subdomain("cp");
			// var_dump($_SESSION['user'] );
		}
	}
}
?>
