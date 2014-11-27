<?php
class main_controller extends mvcController_cls
{
	function config(){
		// ----------------------------------------- logout
		$this->listen(
			array(
				"url" => array("account", "logout")
				),
			function()
			{
				session_unset(); 
				session_destroy();
				header("location: "."/login");
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
