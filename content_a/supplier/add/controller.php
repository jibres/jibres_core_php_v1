<?php
namespace content_a\supplier\add;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('supplier_add')->ALL();
	}
}
?>
