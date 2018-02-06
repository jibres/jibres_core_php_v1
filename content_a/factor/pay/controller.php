<?php
namespace content_a\factor\pay;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\utility::get('id'))
		{
			\lib\error::page(T_("Id not found"));
		}

		$this->get()->ALL();
		$this->post('pay')->ALL();
	}
}
?>
