<?php
namespace content_sudo\fix\sitebuilder;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::fix_store();

	}

	private static function error()
	{
		var_dump(func_get_args());
		exit;
	}

	private static $counter = [];
	private static function counter($_key)
	{
		if(isset(self::$counter[$_key]))
		{
			self::$counter[$_key]++;
		}
		else
		{
			self::$counter[$_key] = 1;
		}
	}


	private static function fix_store()
	{
		$start = microtime(true);

		$list = \lib\db\store\get::all_store_fuel_detail();


		\dash\code::time_limit(0);

		foreach ($list as $key => $value)
		{
			self::one_business($value['id'], $value['fuel'], $value['subdomain']);

			\dash\db\mysql\tools\connection::close();
		}

		var_dump(self::$counter);
		var_dump(microtime(true) - $start);
		var_dump('Complete in '. \dash\utility\human::time(microtime(true) - $start));
		exit();
	}


	private static function one_business($store_id, $fuel, $subdomain)
	{
		if(!$store_id || !$fuel || !$subdomain)
		{
			self::error('No input from function :'. __FUNCTION__, __LINE__);
		}

		$dbname = \dash\engine\store::make_database_name($store_id);

		$query = "	SELECT * FROM pagebuilder where pagebuilder.folder IS NULL ";

		$old_record_pagebuilder = \dash\db::get($query, null, false, $fuel, ['database' => $dbname]);

		if(!$old_record_pagebuilder)
		{
			// var_dump(func_get_args());exit;
			self::counter('business empty pagebuilder records');
			return;
		}

		foreach ($old_record_pagebuilder as $pagebuilder_record)
		{
			self::counter(a($pagebuilder_record, 'type'));
		}
	}

}
?>