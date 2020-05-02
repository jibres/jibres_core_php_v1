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
			$myFuel             = self::get($_force_fuel['fuel']);

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
					$myFuel             = self::get($store_detail['fuel']);
					$myFuel['database'] = $store_detail['db_name'];
				}
				else
				{
					\dash\header::status(507);
					// $myFuel             = self::get();
				}

				return $myFuel;
			}
			else
			{
				// connect to jibres
				$myFuel = self::get('master');
				return $myFuel;
			}
		}
	}



	/**
	 * Gets the specified request.
	 * Get
	 *	 master
	 *	 nic
	 *	 nic_log
	 *	 jibres101
	 *	 jibres203
	 *	 ...
	 *
	 * @param      <type>  $_requested_fuel  The request
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_requested_fuel = null)
	{
		$target = null;

		if(!function_exists('gethostname'))
		{
			\dash\header::status(505, 'Function gethostname not exists');
		}

		$gethostname = gethostname();

		// for example: the request need to connect jibres101 but the local need to connect to reza-jibres
		if(\dash\url::isLocal())
		{
			$target = 'local';
		}
		elseif(in_array($_requested_fuel, ['master', 'nic', 'nic_log', 'api_log', 'shaparak', 'shaparak_log']))
		{
			switch ($_requested_fuel)
			{
				case 'master':
				case 'nic':
				case 'nic_log':
				case 'api_log':
				case 'shaparak':
				case 'shaparak_log':
					$target = 'jibres101';
					break;
			}
		}
		else
		{
			// jibres101, jibres203, ...
			$target = $_requested_fuel;
		}

		$target = $target. '_from_'. $gethostname;

		$result = \dash\setting\fuel::server($target);

		if(isset($result[$_requested_fuel]))
		{
			// return detail for master, nic, nic_log
			return $result[$_requested_fuel];
		}
		else
		{
			if(isset($result['store']))
			{
				return $result['store'];
			}
		}

		return null;
	}


	public static function priority($_tld)
	{
		return "jibres101";
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
