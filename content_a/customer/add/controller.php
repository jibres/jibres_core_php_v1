<?php
namespace content_a\customer\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('customer_add')->ALL();
	}
}
?>
