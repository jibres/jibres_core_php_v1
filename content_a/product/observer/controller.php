<?php
namespace content_a\product\observer;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{


		$this->get(false, 'observer')->ALL("/.*/");
		$this->post('observer')->ALL("/.*/");
	}
}
?>