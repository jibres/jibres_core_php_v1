<?php
namespace content_c\store;

class controller extends \content_c\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		// list of all team the user is them
		$this->get(false, 'list')->ALL();
	}
}
?>