<?php
namespace dash\utility;

/**
* CHECK IP IS BLOCKE
*/
class ip
{

	public static function check($_if_login_is_ok = false)
	{
		if($_if_login_is_ok)
		{
			if(\dash\user::id())
			{
				return true;
			}
		}

		$ip = \dash\server::ip();

		if(self::is_local_ip($ip))
		{
			return true;
		}

		$ip_type = null;
		if(\dash\validate::ipv4($ip, false))
		{
			$ip      = \dash\validate::ipv4($ip, false);
			$load_ip = \dash\db\ip::get_ipv4($ip);
			$ip_type = 'ipv4';
		}
		elseif(\dash\validate::ipv6($ip, false))
		{
			$ip      = \dash\validate::ipv6($ip, false);
			$load_ip = \dash\db\ip::get_ipv6($ip);
			$ip_type = 'ipv6';
		}
		else
		{
			\dash\log::set('InvalidIPNotV4ORV6', ['my_ip' => $ip]);
			\dash\header::status(423, T_("Your ip is not valid!"). '. '. T_("Please contact to administrator"). '.');
		}

		if(isset($load_ip['block']) && $load_ip['block'] === 'block')
		{
			\dash\header::status(423, T_("Your ip is blocked"). '. '. T_("Please contact to administrator"). '.');
		}

		if(isset($load_ip['block']) && $load_ip['block'] === 'unblock')
		{
			return true;
		}

		if(!isset($load_ip['id']))
		{
			self::new_ip($ip, $ip_type);
		}

	}


	private static function is_local_ip($_ip)
	{
		if(substr($_ip, 0, 8) === '127.0.0.')
		{
			return true;
		}
		return false;
	}




	private static function new_ip($_ip, $_type)
	{

		$insert = [];

		if($_type === 'ipv4')
		{
			$insert['ipv4']     = $_ip;
			$insert['ipv4long'] = ip2long($_ip);
		}
		else
		{
			$insert['ipv6'] = $_ip;
		}


		$insert['block']        = 'new';
		$insert['datecreated']  = date("Y-m-d H:i:s");

		\dash\db\ip::insert($insert);

		return true;
	}




	// run this function from cronjob
	public static function block_new_ip()
	{
		$today_modified_count = \dash\db\ip::count_modified_date(date("Y-m-d"));

		if(intval($today_modified_count) > 1000)
		{
			// every day can check 1000 block ip
			return false;
		}

		$new_list = \dash\db\ip::new_list();

		if(!$new_list)
		{
			return null;
		}

		$time         = time();

		foreach ($new_list as $key => $value)
		{
			// try for 45 s
			if((time() - $time) > 45)
			{
				break;
			}

			$my_ip = null;
			if(isset($value['ipv4']) && $value['ipv4'])
			{
				$my_ip = $value['ipv4'];
			}
			elseif(isset($value['ipv6']) && $value['ipv6'])
			{
				$my_ip = $value['ipv6'];
			}

			if(!$my_ip)
			{
				continue;
			}


			$check = self::get_from_server($my_ip);

			if(isset($check[0]))
			{
				$count_block = null;
				if(isset($check[2]) && is_numeric($check[2]))
				{
					$count_block = intval($check[2]);
				}

				if($check[0] == 'Y')
				{
					\dash\db\ip::set_block($value['id'], $count_block);
				}
				elseif($check[0] == 'N')
				{
					\dash\db\ip::set_unblock($value['id'], $count_block);
				}
				else
				{
					\dash\db\ip::set_unknown($value['id'], $count_block);
				}
			}
		}

		return true;
	}


	private static function get_from_server($_ip)
	{

		$apiKey = 'hIenwLNiGpPOoSk';

		if(!$apiKey)
		{
			return false;
		}

		$url    = "http://botscout.com/test/?ip=$_ip&key=$apiKey";
		$data   = file_get_contents($url);

		$explode = explode('|', $data);

		// sample 'MULTI' return string (standard API, not XML)
		// Y|MULTI|IP|4|MAIL|26|NAME|30

		// $explode[0] - 'Y' if found in database, 'N' if not found, '!' if an error occurred
		// $explode[1] - type of test (will be 'MAIL', 'IP', 'NAME', or 'MULTI')
		// $explode[2] - descriptor field for item (IP)
		// $explode[3] - how many times the IP was found in the database
		// $explode[4] - descriptor field for item (MAIL)
		// $explode[5] - how many times the EMAIL was found in the database
		// $explode[6] - descriptor field for item (NAME)
		// $explode[7] - how many times the NAME was found in the database

		return $explode;


	}
}
?>