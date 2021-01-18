<?php
namespace content_crm\telegram\view;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTelegram');

		$id = \dash\request::get('id');
		$load = \dash\app\telegram\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
