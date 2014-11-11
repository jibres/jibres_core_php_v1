<?php
class main_controller extends controller_cls
{
	public function config()
	{
		// @ Hasan: is this listen correct?
		$this->listen(
			array(
				"domain" => "admin",
				),
			array()
		);

		if ($this->url_method())
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
