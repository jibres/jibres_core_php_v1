<?php
namespace content_love\sms\charge\add;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('business_id');
		if($id)
		{
			$load = \lib\app\store\get::data_by_id($id);
			if(!$load)
			{
				\dash\header::status(404, T_("Store not found"));
			}

			\dash\data::dataRow($load);
		}
	}
}

