<?php
namespace content_a\product\edit\general;


class controller
{
	public function ready()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404);
		}

		$this->get()->ALL();
		$this->post('general')->ALL();
	}
}
?>
