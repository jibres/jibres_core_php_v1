<?php
namespace content_a\product\personal;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{


		$this->get(false, 'personal')->ALL("/.*/");
		$this->post('personal')->ALL("/.*/");
	}
}
?>