<?php
namespace content_a\product;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('search')->ALL();
	}
}
?>