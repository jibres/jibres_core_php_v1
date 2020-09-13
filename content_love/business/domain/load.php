<?php
namespace content_love\business\domain;


class load
{
	public static function load()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\business_domain\get::get($id);
		if(!$load)
		{
			\dash\header::status(404, T_("Detail not found"));
		}

		\dash\data::dataRow($load);

	}


	public static function dashboardDetail()
	{
		$result = [];
		$result['dns_count'] = rand();
		$result['log_count'] = rand();
		\dash\data::dashboardDetail($result);
	}
}
?>
