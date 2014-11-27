<?php
class main_controller extends mvcController_cls
{
	public function config()
	{
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
