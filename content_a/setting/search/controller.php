<?php
namespace content_a\setting\search;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

		if(\dash\url::subchild() === 'full' && !\dash\url::dir(3))
		{
			\dash\open::get();
			\lib\app\quickaccess\search::search_in_all();
		}
		else
		{
			\lib\app\quickaccess\search::search_in_setting();
		}

	}
}
?>