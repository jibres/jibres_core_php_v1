<?php
namespace lib\app\upgradedb;

class upgrade
{
	private static $start_time;

	// save all db version
	private static $all_dbversion = [];

	public static function need_upgrade()
	{
		$jibres_last_upgrade_version = self::jibres_last_upgrade_version();
		$jibres_last_version         = self::jibres_last_version();

		$result = [];
		if(version_compare($jibres_last_upgrade_version, $jibres_last_version, '>'))
		{
			$result['jibres'] = ['current' => $jibres_last_version, 'upgrade' => $jibres_last_upgrade_version];
		}


		$store_last_upgrade_version = self::store_last_upgrade_version();
		$store_min_version         = self::store_min_version();

		if(version_compare($store_last_upgrade_version, $store_min_version, '>'))
		{
			$result['store'] = ['current' => $store_min_version, 'upgrade' => $store_last_upgrade_version];
		}

		return $result;
	}


	public static function run()
	{
		self::$start_time = time();

		\dash\code::time_limit(0);

		$jibres_last_upgrade_version = self::jibres_last_upgrade_version();
		$jibres_last_version         = self::jibres_last_version();

		if(version_compare($jibres_last_upgrade_version, $jibres_last_version, '>'))
		{
			self::upgrade_jibres_database($jibres_last_version);
		}


		$store_last_upgrade_version = self::store_last_upgrade_version();
		$store_min_version         = self::store_min_version();

		if(version_compare($store_last_upgrade_version, $store_min_version, '>'))
		{
			self::upgrade_store_database();
		}


		$time = time() - self::$start_time;

		$min = ceil($time / 60);

		\dash\log::to_supervisor("#UpgradeDBComplete in ". $time . " second (". $min. " Min)");

	}


	public static function jibres_last_upgrade_version()
	{
		return self::last_upgrade_version('jibres');
	}


	public static function store_last_upgrade_version()
	{
		return self::last_upgrade_version('store');
	}


	public static function jibres_last_version($_set = null)
	{
		$get = \lib\db\setting\get::by_cat_key('jibres_dabase_upgrade', 'version');

		if($_set)
		{
			\lib\db\setting\update::overwirte_cat_key($_set, 'jibres_dabase_upgrade', 'version');
			return true;
		}

		if(isset($get['value']))
		{
			return $get['value'];
		}
		return null;

		// $version_addr = self::addr(null, 'version');
		// $version_file = $version_addr . 'jibres';
		// $last_version = \dash\file::read($version_file);
		// return $last_version;

	}


	public static function business_db_version_list()
	{
		$result = \lib\db\store\get::all_version_detail();

		if(!$result || !is_array($result))
		{
			$result = [];
		}

		return $result;
	}


	public static function store_min_version()
	{
		$result = \lib\db\store\get::all_version();
		if(!$result)
		{
			return null;
		}

		$min_version = min($result);
		return $min_version;
	}





	/**
	 * ---------------------------------------------------------------------
	 * -------------------- The private functions --------------------------
	 * ---------------------------------------------------------------------
	 */





	private static function addr($_type = null, $_folder = 'upgrade')
	{
		$addr = root.'includes/database/'. $_folder. '/';
		if($_type)
		{
			$addr .= $_type . '/';
		}

		return $addr;
	}


	private static function last_upgrade_version($_type)
	{
		$addr = self::addr($_type);
		if(!is_dir($addr))
		{
			return null;
		}

		$list = glob($addr. '*');
		if(!$list)
		{
			return null;
		}

		$all_version = [];
		foreach ($list as $key => $file)
		{
			$name = basename($file);
			if(preg_match("/^v\.(\d+\.\d+\.\d+)\_(.*)$/", $name, $split))
			{
				$all_version[] = $split[1];

			}
		}

		if(empty($all_version))
		{
			return null;
		}

		$max_version = max($all_version);

		return $max_version;
	}


	private static function upgrade_jibres_database($_last_version)
	{
		$addr = self::addr('jibres');
		if(!is_dir($addr))
		{
			return null;
		}

		$list = glob($addr. '*');
		if(!$list)
		{
			return null;
		}

		$version_addr = self::addr(null, 'version');
		if(!is_dir($version_addr))
		{
			\dash\file::makeDir($version_addr, null, true);
		}

		foreach ($list as $key => $file)
		{
			$name = basename($file);
			if(preg_match("/^v\.(\d+\.\d+\.\d+)\_(.*)$/", $name, $split))
			{
				$current_version = $split[1];
				if(version_compare($current_version, strval($_last_version), '>'))
				{
					$loadFile = \dash\file::read($file);

					self::runMultipleQuery($loadFile, 'master');

					self::jibres_last_version($current_version);
				}
			}
		}
	}


	private static function runMultipleQuery($_queries, $_fuel, $_database = null)
	{
		$queryLine = explode(";", $_queries);

		foreach ($queryLine as $query)
		{
			if(preg_match("/\w+/", $query))
			{
				\dash\pdo::query($query, [], $_fuel, ['database' => $_database]);
			}
		}

	}



	private static function upgrade_store_database()
	{
		$addr = self::addr('store');
		if(!is_dir($addr))
		{
			return null;
		}

		$list = glob($addr. '*');
		if(!$list)
		{
			return null;
		}

		$all_store_version = \lib\db\store\get::all_version_detail();
		$store_fuel = [];
		foreach ($all_store_version as $key => $store)
		{

			$myFuel        = $store['fuel'];
			$store_id      = $store['id'];
			$dbversion     = $store['dbversion'];
			$dbversiondate = $store['dbversiondate'];
			$subdomain     = $store['subdomain'];

			$database_name = \dash\engine\store::make_database_name($store_id);

			$this_store_sql = [];

			// make sql file
			foreach ($list as $file)
			{
				$name = basename($file);
				if(preg_match("/^v\.(\d+\.\d+\.\d+)\_(.*)$/", $name, $split))
				{
					$current_version = $split[1];
					if(version_compare($current_version, $dbversion, '>'))
					{
						$temp_sql = \dash\file::read($file);

						$temp_sql = str_replace('jibres_XXXXXXX', $database_name, $temp_sql);

						self::update_query_db_version($current_version, $store_id);

						self::runMultipleQuery($temp_sql, $myFuel, $database_name);
					}
				}
			}
		}

		self::update_all_database_version();
	}


	private static function temp_store_exec_addr()
	{
		return __DIR__. '/temp.me.exec';
	}


	private static function temp_sql_addr()
	{
		return __DIR__. '/temp.me.sql';
	}


	private static function update_all_database_version()
	{
		if(empty(self::$all_dbversion))
		{
			return;
		}

		$versiondate = date("Y-m-d H:i:s");

		$query = [];
		foreach (self::$all_dbversion as $store_id => $version)
		{
			$query[] = \lib\db\store\get_string::update_db_version($version, $versiondate, $store_id);
		}
	}


	private static function update_query_db_version($_version, $_store_id)
	{
		self::$all_dbversion[$_store_id] = $_version;
	}
}
?>