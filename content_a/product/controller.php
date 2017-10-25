<?php
namespace content_a\product;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get(false, false)->ALL();
	}
}
?>