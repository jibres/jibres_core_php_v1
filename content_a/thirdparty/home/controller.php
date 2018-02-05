<?php
namespace content_a\thirdparty\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
	}
}
?>
