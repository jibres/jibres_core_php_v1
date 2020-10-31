<?php
namespace content_a\category\remove;

class controller
{
	public static function routing()
	{

		$dataRow = \lib\app\category\get::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid category id"));
		}

	}
}
?>