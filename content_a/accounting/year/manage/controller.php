<?php
namespace content_a\accounting\year\manage;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');

		$id = \dash\request::get('id');
		$load = \lib\app\tax\year\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

	}
}
?>
