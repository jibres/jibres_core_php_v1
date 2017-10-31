<?php
namespace content_a\staff;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$url = \lib\router::get_url();

		// LIST
		$this->get(false, 'staff')->ALL("/^staff$/");
		$this->post('staff')->ALL("/^staff$/");

		if(preg_match("/edit\=/", $url))
		{
			\lib\router::set_controller("\\content_a\\staff\\edit\\controller");
			return;
		}

	}
}
?>