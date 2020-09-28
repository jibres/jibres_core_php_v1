<?php
namespace content_my\business\creating;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('title'))
		{
			\dash\redirect::to(\dash\url::this(). '/start');
		}

		if(!\dash\request::get('subdomain'))
		{
			\dash\redirect::to(\dash\url::this(). '/subdomain');
		}
	}
}
?>
