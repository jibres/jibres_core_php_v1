<?php
namespace content_love\plan\add;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('business_id');
		$load = \lib\app\store\get::by_id($id);
		if(!$load)
		{
			\dash\header::status(404, T_("Store not found"));
		}

		\dash\data::dataRow($load);

	}
}
?>
