<?php
namespace content_a\setting\general;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{



		$url = \lib\router::get_url();

		if($url === 'setting/general')
		{
			\lib\error::page();
		}
		$this->get()->ALL("/.*/");
		$this->post('general')->ALL("/.*/");

	}
}
?>