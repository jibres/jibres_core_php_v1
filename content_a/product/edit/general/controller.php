<?php
namespace content_a\product\edit\general;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\request::get('id'))
		{
			\lib\header::status(404);
		}

		$this->get()->ALL();
		$this->post('general')->ALL();
	}
}
?>
