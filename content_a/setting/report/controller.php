<?php
namespace content_a\setting\report;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$this->get(false, 'report')->ALL();
		$this->post('report')->ALL();
	}
}
?>