<?php
namespace lib\app\upgradedb;

class upgrade
{
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
			self::upgrade_store_database($store_min_version);
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


	public static function jibres_last_version()
	{
		$version_addr = self::addr(null, 'version');
		$version_file = $version_addr . 'jibres';
		$last_version = \dash\file::read($version_file);
		return $last_version;
	}


	public static function store_min_version()
	{
		$result = \lib\db\store\get::all_version();
		$result = array_filter($result);
		$result = array_unique($result);
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

		$version_file = $version_addr . 'jibres';

		foreach ($list as $key => $file)
		{
			$name = basename($file);
			if(preg_match("/^v\.(\d+\.\d+\.\d+)\_(.*)$/", $name, $split))
			{
				$current_version = $split[1];
				if(version_compare($current_version, $_last_version, '>'))
				{
					self::runExecJibres($file);
					\dash\file::write($version_file, $current_version);
				}
			}
		}
	}


	private static function runExecJibres($_file)
	{
		$fuel    = \dash\engine\fuel::get('master');
		$exec    = "mysql -u'". $fuel['user']. "' -p'". $fuel['pass']. "' < ". $_file;
		$runExec = exec($exec);
	}


	private static function upgrade_store_database($_last_version)
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

		foreach ($list as $key => $file)
		{
			$name = basename($file);
			if(preg_match("/^v\.(\d+\.\d+\.\d+)\_(.*)$/", $name, $split))
			{
				$current_version = $split[1];
				if(version_compare($current_version, $_last_version, '>'))
				{
					self::runExecStore($file, $current_version);
				}
			}
		}
	}


	private static function runExecStore($_file, $_version)
	{

	}
}
?>