<?php
namespace content_a\product\edit\delete;


class controller
{
	public function ready()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404);
		}

		$this->get()->ALL();
		$this->post('delete')->ALL();
	}
}
?>
