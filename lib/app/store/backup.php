<?php
namespace lib\app\store;


class backup
{
	private static function addr($_db_name, $_zip = false)
	{
		$addr = YARD. 'jibres_temp/stores/backup/';

		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}

		$addr .= $_db_name. '.sql';

		if($_zip)
		{
			$addr .= '.zip';
		}

		return $addr;
	}


	public static function now($_store_id)
	{
		$load = \lib\app\store\get::by_id($_store_id);

		if(!$load)
		{
			return false;
		}

		\dash\code::time_limit(0);

		$db_name = \dash\engine\store::make_database_name($_store_id);

		$addr = self::addr($db_name);

		if(self::get($_store_id))
		{
			self::remove($_store_id);
		}

		$current_fuel_detail = \dash\engine\fuel::get($load['fuel']);


		$backup = \dash\engine\backup\database::backup_cmd($current_fuel_detail, $db_name);
		$backup .= ' > '. $addr;

		$sh = exec($backup, $output);

		$zip = \dash\utility\zip::create($addr. '.zip', $addr, basename($addr));

		\dash\file::delete($addr);

		\dash\notif::ok(T_("Backup complete"));

		return true;


	}


	public static function get($_store_id)
	{
		$db_name = \dash\engine\store::make_database_name($_store_id);

		$addr = self::addr($db_name, true);

		$result = [];

		if(is_file($addr))
		{
			$result['filename'] = $addr;
			$result['date']     = date("Y-m-d H:i:s", filemtime($addr));
		}

		return $result;
	}


	public static function remove($_store_id)
	{
		$db_name = \dash\engine\store::make_database_name($_store_id);

		$addr = self::addr($db_name, true);

		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}

		return true;
	}
}
?>