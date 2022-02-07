<?php
namespace content_love\sms\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \lib\app\sms\get::jibres_sms_get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
