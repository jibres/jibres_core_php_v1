<?php
namespace content_love\smslog\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \lib\app\smslog\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
