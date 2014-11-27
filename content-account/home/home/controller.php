<?php
class controller extends mvcController_cls
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
				header("location: "."/");
				exit();
			}
			);
	}
}
?>
