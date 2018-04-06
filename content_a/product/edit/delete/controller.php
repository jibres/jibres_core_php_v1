<?php
namespace content_a\product\edit\delete;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\dash\request::get('id'))
		{
			\lib\header::status(404);
		}

		$this->get()->ALL();
		$this->post('delete')->ALL();
	}
}
?>
