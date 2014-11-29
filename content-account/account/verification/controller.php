<?php
class controller extends main_controller
{
	public function options()
	{
		if(!get::from() || !get::mobile() || (get::from()!='signup' && get::from()!='recovery') )
		{
			page_lib::access("You cant access to this page!");
		}

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