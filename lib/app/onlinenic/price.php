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

		if($period === null)
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

		$my_pirce = $my_pirce + ((self::wage() * $my_pirce) / 100);

		$my_pirce = $my_pirce + ((self::profit($tld) * $my_pirce) / 100);

		$my_pirce = $my_pirce * self::dollar();

		$my_pirce = ceil($my_pirce);

		$my_pirce = round($my_pirce, -3);

		return $my_pirce;
	}
}
?>