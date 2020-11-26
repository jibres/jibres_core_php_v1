<?php
namespace content_a\setting\sms\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \lib\app\sms\log\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
