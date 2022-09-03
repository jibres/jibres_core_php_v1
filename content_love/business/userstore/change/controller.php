<?php
namespace content_love\business\userstore\change;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \lib\app\store_user\get::get($id);

		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

	}
}
?>
