<?php
namespace content_a\accounting\factor\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
		if(!\dash\request::get('type'))
		{
			\dash\redirect::to(\dash\url::that(). '/choosetype');
		}


		\dash\data::myType(\dash\request::get('type'));

		\dash\allow::file();
	}
}
?>