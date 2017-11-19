<?php
namespace content_a\sell\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('sell_add')->ALL();
	}
}
?>
