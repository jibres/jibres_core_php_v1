<?php
namespace dash;

class server
{
	private static $IP = null;

	/**
	 * { function_description }
	 *
	 * @param      <type>  $_name  The name
	 */
	public static function get($_name = null)
	{
		if(!is_array($_SERVER))
		{
			return null;
		}

		if($_name === null)
		{
			return $_SERVER;
		}

		if(array_key_exists($_name, $_SERVER))
		{
			return $_SERVER[$_name];
		}

		return null;
	}


	// get referer
	public static function referer()
	{
		return self::get("HTTP_REFERER");
	}



	public static function server_ip()
	{
		$server_ip = null;
		if (isset($_SERVER["SERVER_ADDR"]))
		{
			$server_ip = $_SERVER["SERVER_ADDR"];
		}

		return $server_ip;
	}


	public static function ip()
	{
		if(self::$IP)
		{
			return self::$IP;
		}

		return self::ipDetector();
	}


	/**
	 * Function to get the client IP address
	 * @return [type] [description]
	 */
	private static function ipDetector()
	{
		$ipaddress = null;
		switch (\dash\url::domain())
		{
			// cloudflare
			case 'jibres.com':
			case 'jibres.xyz':
			case 'myjibres.com':
				if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
				{
					$ipaddress = $_SERVER["HTTP_CF_CONNECTING_IP"];
				}
				break;

			// cloudflare
			case 'jibres.ir':
			case 'jibres.store':
			case 'myjibres.ir':
				if (isset($_SERVER["HTTP_AR_REAL_IP"]))
				{
					$ipaddress = $_SERVER["HTTP_AR_REAL_IP"];
				}
				break;

			default:

				break;
		}

		if(!$ipaddress)
		{
			if (isset($_SERVER["HTTP_AR_REAL_IP"]))
			{
				$ipaddress = $_SERVER["HTTP_AR_REAL_IP"];
			}
			elseif (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
			{
				$ipaddress = $_SERVER["HTTP_CF_CONNECTING_IP"];
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			elseif(isset($_SERVER['HTTP_X_FORWARDED']))
			{
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			}
			elseif(isset($_SERVER['HTTP_FORWARDED_FOR']))
			{
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			}
			elseif(isset($_SERVER['HTTP_FORWARDED']))
			{
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			}
			elseif(isset($_SERVER['REMOTE_ADDR']))
			{
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			}
		}


		self::$IP = $ipaddress;
		return $ipaddress;
	}


	public static function iplong()
	{
		$ipAddr = self::ip();
		// sprintf will then write it as an unsigned integer.
		$ipAddr = sprintf("%u",ip2long( $ipAddr ));

		return $ipAddr;
	}
}
?>
