<?php
namespace content_a\buy\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('buy_add')->ALL();
	}
}
?>
