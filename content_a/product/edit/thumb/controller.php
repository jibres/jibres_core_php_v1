<?php
namespace content_a\product\edit\thumb;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\utility::get('id'))
		{
			\lib\error::page();
		}

		$this->get()->ALL();
		$this->post('thumb')->ALL();
	}
}
?>
