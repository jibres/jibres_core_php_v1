<?php
namespace content_c\store\add;

class controller extends \content_c\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		// list of all team the user is them
		$this->get()->ALL();
		$this->post('add')->ALL();
	}
}
?>