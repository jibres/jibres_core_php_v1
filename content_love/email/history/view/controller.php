<?php
namespace content_love\email\history\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$load = \dash\email\history::get($id);

		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
