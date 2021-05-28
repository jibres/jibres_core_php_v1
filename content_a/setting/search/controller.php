<?php
namespace content_a\setting\search;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

		\lib\app\quickaccess\search::search_in_all();
	}
}
?>