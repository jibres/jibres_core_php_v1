<?php
namespace content_a\factor\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('factor_add')->ALL();
	}
}
?>
