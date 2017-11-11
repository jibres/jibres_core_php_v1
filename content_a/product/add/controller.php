<?php
namespace content_a\product\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('add')->ALL();
	}
}
?>

