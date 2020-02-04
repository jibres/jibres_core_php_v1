<?php
namespace dash\engine;
/**
 * heh
 */
class fuel
{
	private static $last_get = null;
	private static $header_count = 0;


	public static function get($_request = null)
	{
		if(is_callable(['self', $_request]))
		{
			self::set_header($_request);

			if(\dash\url::isLocal() && $_request !== 'master')
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
		return
		[
			'code'     => __FUNCTION__,
			'host'     => 'localhost',
			'port'     => 3306,
			'user'     => '101x',
			'pass'     => 'ArvanJibres101MySql101!!!!',
			'database' => 'jibres',
		];
	}

	private static function jibres101()
	{
		return
		[
			'code'     => __FUNCTION__,
			// 'host'     => '45.82.139.124',
			'host'     => 'localhost',
			'port'     => 3306,
			'user'     => '101x',
			'pass'     => 'ArvanJibres101MySql101!!!!',
			'database' => null,
		];
	}

	private static function jibres101rg6()
	{
		return
		[
			'code'     => __FUNCTION__,
			'host'     => '45.82.139.124',
			'port'     => 3306,
			'user'     => '101rg6',
			'pass'     => 'ArJibres101MSqg6^^^^*&',
			'database' => null,
		];
	}




	// ----------------------------------------------- Local
	private static function jibres101_test_local()
	{
		return
		[
			'code'     => __FUNCTION__,
			'host'     => '45.82.139.124',
			'port'     => 3306,
			'user'     => 'ermile-local',
			'pass'     => 'Reza1233',
			'database' => null,
		];
	}

	private static function myLocal()
	{
		return
		[
			'code'     => __FUNCTION__,
			'host'     => 'localhost',
			'port'     => 3306,
			'user'     => 'root',
			'pass'     => 'root',
			'database' => 'jibres',
		];
	}

	private static function myStoreLocal()
	{
		return
		[
			'code'     => __FUNCTION__,
			'host'     => 'localhost',
			'port'     => 3306,
			'user'     => 'root',
			'pass'     => 'root',
			'database' => null,
		];
	}


	private static function local()
	{
		return self::jibres101();
		return
		[
			'code'     => __FUNCTION__,
			'host'     => 'localhost',
			'port'     => 3306,
			'user'     => 'root',
			'pass'     => 'root',
			'database' => 'jibres',
		];
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
			return 'Unknow bedroom';
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
