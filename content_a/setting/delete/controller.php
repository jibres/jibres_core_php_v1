<?php
namespace content_a\setting\delete;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{



		$url = \lib\router::get_url();

		if($url === 'setting/delete')
		{
			\lib\error::page();
		}
		$this->get(false, 'delete')->ALL("/.*/");
		$this->post('delete')->ALL("/.*/");

	}
}
?>