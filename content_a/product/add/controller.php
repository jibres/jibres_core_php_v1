<?php
namespace content_a\product\add;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		// list of all team the user is them
		$this->get(false, 'add')->ALL();
		$this->post('add')->ALL();
	}
}
?>