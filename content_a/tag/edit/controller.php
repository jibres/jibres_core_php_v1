<?php
namespace content_a\tag\edit;

class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$dataRow = \lib\app\tag\get::get($id);
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid tag id"));
		}

		\dash\data::myId($id);
		\dash\allow::file();

	}
}
?>