<?php
namespace content_a\product\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		// $this->post('search')->ALL();
	}
}
?>
