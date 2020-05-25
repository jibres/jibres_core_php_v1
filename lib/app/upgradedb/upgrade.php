<?php
namespace lib\app\upgradedb;

class upgrade
{
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

		// $version_file = $version_addr . 'jibres';

		foreach ($list as $key => $file)
		{
			$name = basename($file);
			if(preg_match("/^v\.(\d+\.\d+\.\d+)\_(.*)$/", $name, $split))
			{
				$current_version = $split[1];
				if(version_compare($current_version, $_last_version, '>'))
				{
					self::runExecFile($file, 'master');
					self::jibres_last_version($current_version);
				}
			}
		}
	}


	private static function runExecFile($_file, $_fuel)
	{
		$fuel    = \dash\engine\fuel::get($_fuel);
		// --force on mysql command mean ignore error if happend and continue to other query
		$exec    = "mysql --force -u'$fuel[user]' -p'$fuel[pass]' -h'$fuel[host]' < $_file 2>&1";
		$runExec = exec($exec, $return);


		$log_detail = '@Date: '. date("Y-m-d H:i:s");
		$log_detail .= "\n";
		$log_detail .= '@Query: '. str_repeat('-', 50);
		$log_detail .= "\n";
		$log_detail .= str_replace(' ; ', "\n", file_get_contents($_file));
		$log_detail .= "\n";
		$log_detail .= '@Result: '. str_repeat('-', 50);
		$log_detail .= "\n";
		$log_detail .= implode("\n", $return). "\n";

		\dash\log::file($log_detail, 'upgrade_db_'. date("Y_m_d_H_i_s"), 'upgrade_database');

		// \dash\file::append(__DIR__.'/log.me.json', date("Y-m-d H:i:s"). "\n");
		// // \dash\file::append(__DIR__.'/log.me.json', 'exec command: '. $exec. "\n");
		// \dash\file::append(__DIR__.'/log.me.json', 'exec result: '. $runExec. "\n");
		// \dash\file::append(__DIR__.'/log.me.json', 'exec all result: '. implode("\n", $return). "\n");

		// End line of sql file write SELECT 'OK'; to return ok in exec result ;)
		if($runExec === 'OK')
		{
			// Everything is ok
		}
		else
		{
			// have error!
		}
		// save log return in file
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
						// $temp_sql .= ' -- '. $subdomain;
						self::update_query_db_version($current_version, $store_id);
						$this_store_sql[] = $temp_sql;
					}
				}
			}

			if($this_store_sql)
			{
				// set on the fuel list
				if(!isset($store_fuel[$myFuel]))
				{
					$store_fuel[$myFuel] = [];
				}

				$store_fuel[$myFuel][] = $this_store_sql;
			}
		}

		foreach ($store_fuel as $fuel => $query)
		{
			$temp_addr = self::temp_store_exec_addr();
			$query = array_map(function($_a) {return implode(' ; ', $_a);}, $query);
			$query = implode(' ; ', $query);
			\dash\file::write($temp_addr, $query);
			self::runExecFile($temp_addr, $fuel);
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

		\dash\file::write(self::temp_sql_addr(), implode(";\n", $query));
		self::runExecFile(self::temp_sql_addr(), 'master');
	}


	private static function update_query_db_version($_version, $_store_id)
	{
		self::$all_dbversion[$_store_id] = $_version;
	}
}
?>