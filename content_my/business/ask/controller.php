<?php
namespace content_my\business\ask;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('title'))
		{
			\dash\redirect::to(\dash\url::this(). '/start');
		}

		\dash\csrf::set();
	}
}
?>
