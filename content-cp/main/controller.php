<?php
class main_controller extends mvcController_cls
{
	public function config()
	{
		if($this->login())
		{
			var_dump( 'User Logined to system. Nickname: ' . $_SESSION['user']['nickname'] );
		}
		else
		{
			debug_lib::warn("You must login to use admin");
			$this->redirect('login')->subdomain("account");
		}

		if (config_lib::$method)
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
					// "url" => array("/.*/", "edit" => "/^[a-z0-9-]+$/")
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "delete" => "/^[0-9]{1,10}+$/")
					// "url" => array("/.*/", "delete" => "/^\d+$/")
					),
				array( 'mod' => 'delete')
			);
		}
	}
}
?>
