<?php
namespace content_my\ticket\show;

class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::this(). '/view'. \dash\request::full_get());
	}
}
?>
