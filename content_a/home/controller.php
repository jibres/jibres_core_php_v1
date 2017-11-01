<?php
namespace content_a\home;


class controller extends \content_a\main\controller
{
	function ready()
	{
		$this->get()->ALL();
	}
}
?>