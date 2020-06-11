<?php
namespace content_a\cart\add;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('user'))
		{
			\dash\redirect::to(\dash\url::this() . '/user');
		}

	}
}
?>
