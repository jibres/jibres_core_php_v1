<?php
namespace content_a\factor\export;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}

		$this->get()->ALL();
	}
}
?>
