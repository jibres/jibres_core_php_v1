<?php
namespace content_management\analytics;


class controller
{
	public static function routing()
	{
		if(!\dash\permission::supervisor())
		{
			// \dash\redirect::to(\dash\url::here());
		}
	}
}
?>
