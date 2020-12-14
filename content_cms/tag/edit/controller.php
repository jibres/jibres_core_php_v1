<?php
namespace content_cms\tag\edit;

class controller
{
	public static function routing()
	{

		$dataRow = \dash\app\terms\get::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(a($dataRow, 'type') !== 'tag')
		{
			\dash\header::status(404);
		}

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid tag id"));
		}

	}
}
?>