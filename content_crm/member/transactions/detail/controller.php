<?php
namespace content_crm\member\transactions\detail;

class controller
{
	public static function routing()
	{
		\content_crm\member\master::load();

		$id = \dash\request::get('tid');

		$load = \dash\app\transaction\get::get($id);

		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>