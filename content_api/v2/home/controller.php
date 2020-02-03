<?php
namespace content_api\v2\home;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::this(). '/doc');
	}
}
?>