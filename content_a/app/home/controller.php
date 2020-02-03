<?php
namespace content_a\app\home;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::this(). '/android');
	}
}
?>
