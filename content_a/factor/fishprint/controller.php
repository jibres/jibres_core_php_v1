<?php
namespace content_a\factor\fishprint;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\request::get('id'))
		{
			\lib\error::page(T_("Id not found"));
		}

		$this->get()->ALL();
	}
}
?>
