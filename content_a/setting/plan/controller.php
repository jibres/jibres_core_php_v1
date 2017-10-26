<?php
namespace content_a\setting\plan;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{

		$this->get(false, 'plan')->ALL();
		$this->post('plan')->ALL();

	}
}
?>