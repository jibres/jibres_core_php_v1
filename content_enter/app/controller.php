<?php
namespace content_enter\app;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::here());

		\dash\csrf::set(true);
	}
}
?>