<?php
class controller extends main_controller
{
	public function config() 
	{
		// ----------------------------------------- accounts
		$this->listen(
		array(
			"domain" => "admin"
			),
		array("admin", 'home')
		);

	}
}
?>