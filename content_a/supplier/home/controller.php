<?php
namespace content_a\supplier\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
	}
}
?>
