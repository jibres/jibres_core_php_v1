<?php
namespace content_pardakhtyar;


class controller
{
	public static function routing()
	{
		if(!\dash\user::login())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/enter?referer='. \dash\url::pwd(), 'direct');
			return;
		}

		\dash\permission::access('contentA');
	}
}
?>