<?php
namespace content_a\tag\edit;

class controller
{
	public static function routing()
	{

		$dataRow = \lib\app\tag\get::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid tag id"));
		}

	}
}
?>