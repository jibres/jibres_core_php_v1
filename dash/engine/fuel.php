<?php
namespace dash\engine;
/**
 * heh
 */
class fuel
{
	private static $last_get = null;
	private static $header_count = 0;


	public static function who($_force_fuel = null)
	{
		if(isset($_force_fuel['fuel']) && $_force_fuel['fuel'] && is_string($_force_fuel['fuel']))
		{
			$myFuel             = \dash\engine\fuel::get($_force_fuel['fuel']);

			if(isset($_force_fuel['database']) && $_force_fuel['database'])
			{
				$myFuel['database'] = $_force_fuel['database'];
			}

			return $myFuel;
		}
		else
		{
			if(\dash\engine\store::inStore())
			{
				// connect to store
				$store_detail = \dash\engine\store::store_detail();
				if(isset($store_detail['fuel']) && isset($store_detail['db_name']))
				{
					$myFuel             = \dash\engine\fuel::get($store_detail['fuel']);
					$myFuel['database'] = $store_detail['db_name'];
				}
				else
				{
					$myFuel             = \dash\engine\fuel::get();
				}

				return $myFuel;
			}
			else
			{
				// connect to jibres
				$myFuel = \dash\engine\fuel::master();
				return $myFuel;
			}
		}
	}

	public static function get($_request = null)
	{
		if(is_callable(['self', $_request]))
		{
			self::set_header($_request);

			if(\dash\url::isLocal() && $_request !== 'master' && $_request !== 'nic_log' && $_request !== 'nic')
			{
				return self::myStoreLocal();
			}

			return self::$_request();
		}

		return null;
	}


	public static function priority($_tld)
	{
		if(\dash\url::isLocal())
		{
			return 'myLocal';
		}

		return "jibres101";
	}


	public static function master()
	{
		self::set_header('master');

		if(\dash\url::isLocal())
		{
			return self::myLocal();
		}

		return self::jibres_master();
	}


	// ----------------------------------------------- list of servers

	/**
	 * Jibres Master
	 * @return [type] [description]
	 */
	private static function jibres_master()
	{
		return \dash\setting\fuel::server(__FUNCTION__);
	}

	private static function jibres101()
	{
		return \dash\setting\fuel::server(__FUNCTION__);
	}

	private static function jibres101rg6()
	{
		return \dash\setting\fuel::server(__FUNCTION__);
	}

	private static function local()
	{
		return self::jibres101();
	}


	private static function nic_log()
	{
		if(\dash\url::isLocal())
		{
			return \dash\setting\fuel::server('nic_log_local');
		}

		return \dash\setting\fuel::server('nic_log');
	}


	private static function nic()
	{
		if(\dash\url::isLocal())
		{
			return \dash\setting\fuel::server('nic_local');
		}

		return \dash\setting\fuel::server('nic');
	}


	// ----------------------------------------------- Local
	private static function jibres101_test_local()
	{
		return \dash\setting\fuel::server(__FUNCTION__);
	}

	private static function myLocal()
	{
		return \dash\setting\fuel::server(__FUNCTION__);
	}

	private static function myStoreLocal()
	{
		return \dash\setting\fuel::server(__FUNCTION__);
	}



	public static function server_code_name($_ip)
	{
		$server_code_name = \dash\setting\fuel::server_name($_ip);

		if($server_code_name)
		{
			return $server_code_name;
		}
		else
		{
			return 'Unknown bedroom';
		}
	}


	private static function set_header($_request)
	{
		if($_request !== self::$last_get)
		{
			self::$last_get = $_request;
			self::$header_count++;
			@header('lastFuel_'. self::$header_count. ': '. $_request);
		}
	}
}
?>
