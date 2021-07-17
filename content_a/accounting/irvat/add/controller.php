<?php
namespace content_a\accounting\irvat\add;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('type'))
		{
			\dash\redirect::to(\dash\url::that(). '/choosetype');
		}


		\dash\data::myType(\dash\request::get('type'));

		\dash\allow::file();
	}
}
?>