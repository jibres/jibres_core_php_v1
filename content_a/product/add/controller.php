<?php
namespace content_a\product\add;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get(false, 'add')->ALL();
		$this->post('add')->ALL();
	}
}
?>