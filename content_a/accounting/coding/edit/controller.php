<?php
namespace content_a\accounting\coding\edit;


class controller
{
	public static function routing()
	{

		\dash\permission::access('_group_setting');

		$id = \dash\request::get('id');
		$load = \lib\app\tax\coding\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		\dash\data::myType(\dash\data::dataRow_type());

	}
}
?>
