<?php
namespace content_a\staff\edit\identification;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('identification')->ALL();
	}
}
?>