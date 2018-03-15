<?php
namespace content_a\product\edit\delete;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\request::get('id'))
		{
			\lib\error::page();
		}

		$this->get()->ALL();
		$this->post('delete')->ALL();
	}
}
?>
