<?php
namespace content_a\setting\order\schedule;


class model
{
	public static function post()
	{
		\lib\app\factor\schedule_order::save(\dash\request::post());

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>