<?php
namespace content_a\android\intro;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');
		\dash\allow::file();
	}
}
?>
