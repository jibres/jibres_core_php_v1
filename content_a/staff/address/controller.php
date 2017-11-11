<?php
namespace content_a\staff\address;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('address')->ALL();
	}
}
?>