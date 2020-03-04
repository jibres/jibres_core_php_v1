<?php
namespace lib\app\application;


class queue
{

	public static function detail()
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}


		$store_app_detail = \lib\db\store_app\get::jibres_my_app_detail(\lib\store::id());

		return $store_app_detail;

	}
}
?>