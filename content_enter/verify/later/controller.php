<?php
namespace content_enter\verify\later;


class controller
{
	public static function routing()
	{
		\dash\log::set('TryToVerifyLater');
		\dash\redirect::to(\dash\url::this());

		\dash\utility\ip::check();
	}
}
?>