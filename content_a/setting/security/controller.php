<?php
namespace content_a\setting\security;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{



		$url = \lib\router::get_url();

		if($url === 'setting/security')
		{
			\lib\error::page();
		}
		$this->get(false, 'security')->ALL("/.*/");
		$this->post('security')->ALL("/.*/");

	}
}
?>