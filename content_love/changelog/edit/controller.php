<?php
namespace content_love\changelog\edit;


class controller
{
	public static function routing()
	{
		\dash\allow::html();
		$id = \dash\request::get('id');
		$load = \dash\app\changelog::get($id);
		if(!$id)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		\dash\data::editMode(true);
	}
}
?>
