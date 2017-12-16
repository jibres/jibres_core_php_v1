<?php
namespace content_a\buy\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\utility::get('id'))
		{
			\lib\error::page(T_("Id not found"));
		}

		$this->post('buy_edit')->ALL();
	}
}
?>
