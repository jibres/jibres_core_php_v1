<?php
namespace content_a\setting\factor;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$url = \lib\url::directory();

		$this->get()->ALL();
		$this->post('factor')->ALL();

	}
}
?>