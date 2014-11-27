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
				header("location: "."/login");
				exit();
			}
		);
		
		if(!$this->login())
		{
			$this->listen(array(
				"real_url" => array("/^(?!login)/")
					),
				function(){
					header("Location: /login");
					exit();
				});
		}
	}
}
?>
