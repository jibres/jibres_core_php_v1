<?php
namespace content_a\supplier\edit\general;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('general')->ALL();
	}
}
?>
