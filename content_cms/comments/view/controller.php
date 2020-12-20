<?php
namespace content_cms\comments\view;

class controller
{

	public static function routing()
	{
		$id = \dash\request::get('id');

		$dataRow = \dash\app\comment\get::get($id);
		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid comment id"));
		}

		\dash\data::dataRow($dataRow);
	}
}
?>