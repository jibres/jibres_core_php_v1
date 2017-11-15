<?php
namespace content_a\supplier\edit\contact;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('contact')->ALL();
	}
}
?>
