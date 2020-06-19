<?php
namespace content_a\category\edit;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryEdit');

		$dataRow = \lib\app\category\get::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid category id"));
		}

	}
}
?>