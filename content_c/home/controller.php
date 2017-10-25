<?php
namespace content_c\home;

class controller extends \content_c\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		// list of all team the user is them
		$this->get(false, 'dashboard')->ALL();
	}
}
?>