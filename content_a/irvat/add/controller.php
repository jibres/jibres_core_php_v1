<?php
namespace content_a\irvat\add;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('type'))
		{
			\dash\redirect::to(\dash\url::this(). '/choosetype');
		}
	}
}
?>