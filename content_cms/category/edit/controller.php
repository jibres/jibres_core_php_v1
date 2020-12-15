<?php
namespace content_cms\category\edit;

class controller
{
	public static function routing()
	{

		$dataRow = \dash\app\terms\get::get(\dash\request::get('id'));

		if(a($dataRow, 'type') !== 'cat')
		{
			\dash\header::status(404, T_("This is not category"));
		}

		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid category id"));
		}

	}
}
?>