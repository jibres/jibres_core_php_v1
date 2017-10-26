<?php
namespace content_a\setting\logo;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$this->get()->ALL();
		$this->post('logo')->ALL();
	}
}
?>