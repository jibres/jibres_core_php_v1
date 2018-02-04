<?php
namespace content_a\setting\factor;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$url = \lib\router::get_url();

		$this->get()->ALL();
		$this->post('factor')->ALL();

	}
}
?>