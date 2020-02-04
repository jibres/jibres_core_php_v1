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
