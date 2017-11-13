<?php
namespace content_a\staff\edit\general;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('general')->ALL();
	}
}
?>
