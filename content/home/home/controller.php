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
			header("location: http://account.".DOMAIN."/login");
			exit();
		}
		);
	}
}
?>