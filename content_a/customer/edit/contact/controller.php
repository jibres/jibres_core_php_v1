<?php
namespace content_a\customer\edit\contact;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('contact')->ALL();
	}
}
?>
