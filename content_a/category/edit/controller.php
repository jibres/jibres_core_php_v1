<?php
namespace content_a\category\edit;

class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$dataRow = \lib\app\category\get::get($id);
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid category id"));
		}

		\dash\data::myId($id);
		\dash\allow::file();

	}
}
?>