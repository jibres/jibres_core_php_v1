<?php
namespace content_a\accounting\doc\edit;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');
		$load = \lib\app\tax\doc\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

	}
}
?>
