<?php
namespace content_love\plan\detail;


use lib\app\plan\planReady;

class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \lib\app\plan\planGet::get($id);
		if(!$load)
		{
			\dash\header::status(404, T_("Plan not found"));
		}

		\lib\app\plan\planReady::calculateDays($load);


		\dash\data::dataRow($load);

		$store_id = a($load, 'store_id');
		if($store_id)
		{
			$storeData = \lib\app\store\get::data_by_id($store_id);
			\dash\data::storeDetail($storeData);
		}

	}
}
