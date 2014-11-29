<?php
class main_controller extends mvcController_cls
{
	public function config()
	{

		if($this->login())
		{
			// var_dump( 'User Logined to system. Nickname: ' . $_SESSION['user']['nickname'] );
		}
		else
		{
			debug_lib::warn("You must login to use admin");
			$this->redirect('login')->subdomain("account");
		}
		// var_dump(config_cls::$project);

		if (config_lib::$method !='home')
		{
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array('add')
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "edit" => "/^[0-9]{1,10}+$/")
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "delete" => "/^[0-9]{1,10}+$/")
					),
				array( 'mod' => 'delete')
			);
		}
	}
}
?>
