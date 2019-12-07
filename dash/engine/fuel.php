<?php
namespace dash\engine;
/**
 * heh
 */
class fuel
{
	public static function get($_request = null)
	{
		if(is_callable(['self', $_request]))
		{
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
			'host'     => '45.82.139.124',
			'port'     => 3306,
			'user'     => 'ermile-local',
			'pass'     => 'Reza1233',
			'database' => 'jibres',
		];
	}

	private static function jibres101()
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
}
?>
