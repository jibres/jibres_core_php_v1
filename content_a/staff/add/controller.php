<?php
namespace content_a\staff\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('staff_add')->ALL();
	}
}
?>
