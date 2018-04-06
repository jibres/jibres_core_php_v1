<?php
namespace content_a\setting\general;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$url = \dash\url::directory();

		$this->get()->ALL();
		$this->post('general')->ALL();

	}
}
?>