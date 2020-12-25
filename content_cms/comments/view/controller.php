<?php
namespace content_cms\comments\view;

class controller
{

	public static function routing()
	{
		$cid = \dash\request::get('cid');

		$dataRow = \dash\app\comment\get::get($cid);
		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid comment id"));
		}

		\dash\data::dataRow($dataRow);
	}
}
?>