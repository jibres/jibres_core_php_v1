<?php
namespace content_crm\ticket\edit;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');
		$load = \dash\app\ticket\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		\dash\allow::file();
	}
}
?>
