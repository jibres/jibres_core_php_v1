<?php
namespace lib\app\onlinenic;


class price
{
	private static function dollar()
	{
		return 27000; // toman
		// return 31000; // toman // date: 2020-11-26
		// return 26000; // toman // date: 2020-9-28
		// return 19000; // toman // date: 2020-06-18
	}

	private static function wage()
	{
		return 2.9; // percent
	}

	private static function profit($_tld = null)
	{
		$profit = 10; // percent

		switch ($_tld)
		{
			case 'com':
				$profit = 4;
				break;
		}

		return $profit;
	}



	public static function one_year($_tld)
	{
		$tld = \dash\validate::string_50($_tld, false);
		if(!$tld)
		{
			return null;
		}

		$get_all = self::get_all();

		if(isset($get_all['.'. $tld]['price']))
		{
			return $get_all['.'. $tld]['price'];
		}
		return null;

	}


	public static function five_year($_tld)
	{
		$tld = \dash\validate::string_50($_tld, false);
		if(!$tld)
		{
			return null;
		}

		$get_all = self::get_all();

		if(isset($get_all['.'. $tld]['price5']))
		{
			return $get_all['.'. $tld]['price5'];
		}
		return null;

	}


	public static function price_com_1_year()
	{
		$dollar = 8.89;
		return self::toman_price($dollar, 'com');
	}


	public static function renew($_domain, $_period)
	{
		return self::get_price($_domain, $_period, 'renew');
	}


	public static function get_price($_domain, $_period, $_type)
	{
		$info = \lib\app\onlinenic\check::check($_domain, $_type);

		if(!isset($info['prices']))
		{
			\dash\notif::error(T_("Error in load domain price detail"));
			return false;
		}

		$split = explode('.', $_domain);
		$tld   = end($split);

		if($_period === null)
		{
			$_period = 0;
		}

		if(!isset($info['prices'][$_period]))
		{
			\dash\notif::error(T_("This period of domain have not price!"));
			return false;
		}

		$my_pirce = floatval($info['prices'][$_period]);


		return self::toman_price($my_pirce, $tld);
	}


	/**
	 * Convert dollar to toman by calc wage and profit
	 */
	private static function toman_price($_dollar, $_tld = null)
	{
		$my_pirce = floatval($_dollar);

		$my_pirce = $my_pirce + ((self::wage() * $my_pirce) / 100);

		$my_pirce = $my_pirce + ((self::profit($_tld) * $my_pirce) / 100);

		$my_pirce = $my_pirce * self::dollar();

		$my_pirce = round($my_pirce, -3);

		return $my_pirce;

	}




	public static function get_list($_domain, $_type)
	{
		$info = \lib\app\onlinenic\check::check($_domain, $_type);

		if(!isset($info['prices']))
		{
			\dash\notif::error(T_("Error in load domain price detail"));
			return false;
		}

		if(!is_array($info['prices']))
		{
			return false;
		}

		$split = explode('.', $_domain);
		$tld   = end($split);

		$list = [];

		foreach ($info['prices'] as $key => $dollar)
		{
			$title = null;
			switch ($key)
			{
				case '1': $title = T_("1 Year"); break;
				case '2': $title = T_("2 Year"); break;
				case '3': $title = T_("3 Year"); break;
				case '4': $title = T_("4 Year"); break;
				case '5': $title = T_("5 Year"); break;
				case '6': $title = T_("6 Year"); break;
				case '7': $title = T_("7 Year"); break;
				case '8': $title = T_("8 Year"); break;
				case '9': $title = T_("9 Year"); break;
				case '10': $title = T_("10 Year"); break;
			}
			$list[] = ['period' => $key, 'title' => $title, 'price' => self::toman_price($dollar, $tld)];
		}

		return $list;


	}



	public static function get_all()
	{

		$pricing = self::convert_csv_to_json();

		if(!is_array($pricing))
		{
			$pricing = [];
		}


		return $pricing;
	}

	private static $price_list = [];
	private static function convert_csv_to_json()
	{
		if(!self::$price_list)
		{
			$dir = __DIR__. '/pricing.csv';
			if(is_file($dir))
			{
				$list = \dash\utility\import::csv($dir);
				if(!$list || !is_array($list))
				{
					return false;
				}

				$pricing = [];
				foreach ($list as $key => $value)
				{
					if(isset($value['domain']) && isset($value['type']))
					{
						if($value['type'] === 'domainregister')
						{
							if(isset($value['1 year']) && isset($value['5 years']))
							{
								$pricing[$value['domain']] =
								[
									'tld'    => $value['domain'],
									'type'   => $value['type'],
									'dollar' => $value['1 year'],
									'price'  => self::toman_price($value['1 year'], substr($value['domain'], 1)),
									'price5' => self::toman_price($value['5 years'], substr($value['domain'], 1))
								];
							}
						}
					}
				}

				if(!empty($pricing))
				{
					self::$price_list = $pricing;
					// \dash\file::write(__DIR__. '/pricing-v2.me.json', json_encode($pricing, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
				}
			}
		}
		return self::$price_list;
	}
}
?>