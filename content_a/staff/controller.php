<?php
namespace content_a\staff;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		\lib\router::set_controller("\\content_a\\staff\\edit\\controller");
		return;
	}
}
?>