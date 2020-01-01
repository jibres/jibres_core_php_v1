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

			return self::$_request();
		}

		return null;
	}


	public static function priority($_tld)
	{
		return "jibres101";
	}


	public static function master()
	{
		self::set_header('master');
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


	private static function local()
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




	public static function server_code_name($_ip)
	{
		$code_servers =
		[
			'127.0.0.1'       => 'local1',
			'127.0.0.2'       => 'local2',

			'45.82.139.124'   => '101',
			'193.176.242.143' => 'g6',
			'193.176.242.25'  => 'g4',

		];

		if(isset($code_servers[$_ip]))
		{
			return $code_servers[$_ip];
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
