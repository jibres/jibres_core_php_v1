<?php
namespace content_a\staff\home;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get()->ALL();
		// \lib\router::set_controller("\\content_a\\staff\\edit\\controller");
		// return;
	}
}
?>