<?php
namespace content_a\chap;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::here());
		}

		\dash\permission::access('factorAccess');

		$child = \dash\url::child();
		if(in_array($child, ['fishprint', 'a4', 'a5']))
		{
			\dash\open::get();
		}
	}
}
?>
