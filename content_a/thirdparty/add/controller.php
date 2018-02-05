<?php
namespace content_a\thirdparty\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('thirdparty_add')->ALL();
	}
}
?>
