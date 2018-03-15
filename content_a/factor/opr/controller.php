<?php
namespace content_a\factor\opr;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\request::get('id'))
		{
			\lib\error::page(T_("Id not found"));
		}

		$this->get()->ALL();
		$this->post('opr')->ALL();
	}
}
?>
