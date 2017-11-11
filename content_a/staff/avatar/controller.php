<?php
namespace content_a\staff\avatar;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		$this->post('avatar')->ALL();
	}
}
?>