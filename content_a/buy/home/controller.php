<?php
namespace content_a\buy\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
	}
}
?>
