<?php
namespace dash\engine;
/**
 * heh
 */
class fuel
{
	public static function get($_request = null)
	{
		if(\dash\url::isLocal())
		{
			return self::local();
		}

		if(method_exists(self, $_request))
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
		if(\dash\url::isLocal())
		{
			return self::local();
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
			'code'  => __FUNCTION__,
			'host'  => '45.82.139.124',
			'port'  => 3306,
			'user'  => 'ermile-local',
			'pass'  => 'Reza1233',
		];
	}

	private static function jibres101()
	{
		return
		[
			'code'  => __FUNCTION__,
			'host'  => '45.82.139.124',
			'port'  => 3306,
			'user'  => 'ermile-local',
			'pass'  => 'Reza1233',
		];
	}





	// ----------------------------------------------- Local
	private static function jibres101_test_local()
	{
		return
		[
			'code'  => __FUNCTION__,
			'host'  => '45.82.139.124',
			'port'  => 3306,
			'user'  => 'ermile-local',
			'pass'  => 'Reza1233',
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
