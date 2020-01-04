<?php
namespace content_m\analytics;


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
