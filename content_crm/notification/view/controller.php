<?php
namespace content_crm\notification\view;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_crm');

		$id = \dash\request::get('id');
		$load = \dash\app\log\get::get_notif($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

	}
}
?>
