<?php
namespace lib\app\onlinenic;


class price
{
	private static function dollar()
	{
		return 19000; // toman
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
				$profit = 5;
				break;
		}

		return $profit;
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
			var_dump($info);exit();
		}
		else
		{
			if(!isset($info['prices'][$_period]))
			{
				\dash\notif::error(T_("This period of domain have not price!"));
				return false;
			}
			$my_pirce = floatval($info['prices'][$_period]);
		}

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

		$my_pirce = ceil($my_pirce);

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


}
?>