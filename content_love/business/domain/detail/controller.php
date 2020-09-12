<?php
namespace content_love\business\domain\detail;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\business_domain\get::get($id);
		if(!$load)
		{
			\dash\header::status(404, T_("Detail not found"));
		}

		\dash\data::dataRow($load);

	}
}
?>
