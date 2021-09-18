<?php
namespace content_a\discount\edit;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\discount\get::get($id);

		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::editMode(true);

		\dash\data::dataRow($load);
	}
}
?>