<?php
namespace content_site\page;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::here());
		}
	}
}
?>