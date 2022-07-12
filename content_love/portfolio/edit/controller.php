<?php
namespace content_love\portfolio\edit;


class controller
{
	public static function routing()
	{
		\dash\allow::file();
		$id = \dash\request::get('id');
		$load = \dash\app\portfolio::get($id);
		if(!$id)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		\dash\data::editMode(true);
	}
}
?>
