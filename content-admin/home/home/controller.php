<?php
class controller extends main_controller
{
	public function config() 
	{
		// ----------------------------------------- accounts
		$this->listen(
		array(
			"domain" => "admin",
			// "max" => 1,
			),
		array("admin", 'home')
		);


	}
}
?>