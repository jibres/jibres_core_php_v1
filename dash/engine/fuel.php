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


	/**
	 * get master database array or name
	 *
	 * @param      boolean  $_get_array
	 */
	public static function master($_get_array = false)
	{
		if(\dash\url::isLocal())
		{
			if($_get_array)
			{
				return self::local();
			}
			else
			{
				return 'local';
			}
		}

		if($_get_array)
		{
			return self::jibres_master();
		}
		else
		{
			return 'jibres_master';
		}

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
