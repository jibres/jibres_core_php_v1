<?php
namespace content_love\telegram\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \dash\app\telegram\get::api_telegram_get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
