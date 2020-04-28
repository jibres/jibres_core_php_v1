<?php
namespace content_my\ipg\setup;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::this());
	}
}
?>