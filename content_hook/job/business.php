<?php
namespace content_hook\job;


class business
{
	public static function run($_fn)
	{
		$list = \lib\db\store\get::all_store_fuel_detail();
		if(!is_array($list))
		{
			$list = [];
		}

		foreach ($list as $key => $value)
		{
			\dash\engine\process::continue();

			\dash\engine\store::force_lock($value);

			call_user_func($_fn);

			\dash\pdo::close();

		}
	}


	public static function run_once($_fn, $_busy_key = null)
	{
		if(\dash\utility\busy::is_busy('cronjob_business_once_'. $_busy_key))
		{
			return;
		}

		\dash\utility\busy::set_busy('cronjob_business_once_'. $_busy_key);

		self::run($_fn);

		\dash\utility\busy::set_free('cronjob_business_once_'. $_busy_key);

	}
}
?>