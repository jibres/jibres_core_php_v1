<?php
namespace content_a\sell\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\utility::get('id'))
		{
			\lib\error::page(T_("Id not found"));
		}

		$this->post('sell_edit')->ALL();
	}
}
?>
