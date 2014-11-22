<?php
class controller extends main_controller
{
	public function options()
	{
		$this->listen(
			array(
				"min" => 1,
				"max" => 1,
				"url" => array("/.*/", "code" => "/^[0-9a-f]{32}$/i")
				),
			array( 'mod' => 'code')
		);
	}
}
?>