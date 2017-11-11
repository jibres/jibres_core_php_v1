<?php
namespace content_c\store;


class controller extends \content_c\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{
		$this->get()->ALL();
	}
}
?>
