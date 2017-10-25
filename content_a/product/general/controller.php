<?php
namespace content_a\product\general;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{


		$this->get(false, 'general')->ALL("/.*/");
		$this->post('general')->ALL("/.*/");
	}
}
?>