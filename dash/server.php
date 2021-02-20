<?php
namespace dash;

class server
{

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



	public static function server_ip($_change = null)
	{
		$server_ip = null;
		if (isset($_SERVER["SERVER_ADDR"]))
		{
			$server_ip = $_SERVER["SERVER_ADDR"];
		}

		if($_change)
		{
			// sprintf will then write it as an unsigned integer.
			$server_ip = sprintf("%u",ip2long( $server_ip ));
		}

		return $server_ip;
	}



	/**
	 * Function to get the client IP address
	 * @return [type] [description]
	 */
	public static function ip($_change = null)
	{
		$ipaddress = null;
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
		{
			$ipaddress = $_SERVER["HTTP_CF_CONNECTING_IP"];
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
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
		else
		{
			$ipaddress = null;
		}

		// check ip is valid or not
		if(!filter_var($ipaddress, FILTER_VALIDATE_IP))
		{
			return false;
		}

		if($_change)
		{
			// sprintf will then write it as an unsigned integer.
			$ipaddress = sprintf("%u",ip2long( $ipaddress ));
			// $ipaddress = ip2long( $ipaddress );
		}

		$ipaddress = \dash\safe::safe($ipaddress);

		return $ipaddress;
	}
}
?>
