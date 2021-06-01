<?php
namespace content_a\site\builder;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>