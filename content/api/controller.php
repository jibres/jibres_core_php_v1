<?php
namespace content\api;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::api('developers'));
	}
}
?>