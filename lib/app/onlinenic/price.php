<?php
namespace lib\app\onlinenic;


class price
{
	private static function dollar()
	{
        return 40000;
        // return 30000; // 2022-07-28
		// return 32000; // 2022-04-08
		// return 29957; // 2021-12-05
		// return 29957; // 2021-09-15
		// return 29600; // 2021-09-06
		// return 26100; // 2021-08-26
		// return 31000; // 2020-11-26
		// return 26000; // 2020-09-28
		// return 19000; // 2020-06-18

		// .com domain
		// 8.89 $ onlinenic without wage
		// 8.89 + 2.9% = 9.14 $ from online nic
		// 9.14 + 4% profit = 9.5 $
		//
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
			case '.com':
				$profit = 5;
				break;
		}

		return $profit;
	}


	public static function quick_renew($_tld, $_year)
	{
		$tld = \dash\validate::string_50($_tld, false);
		if(!$tld)
		{
			return null;
		}

		$get_all = self::get_all();

		if(isset($get_all['.'. $tld]['price'. $_year]))
		{
			return $get_all['.'. $tld]['price'. $_year];
		}
		return null;

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
			\dash\notif::error_once(T_("Error in load domain price detail"));
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
			\dash\notif::error_once(T_("This period of domain have not price!"));
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
			\dash\notif::error_once(T_("Error in load domain price detail"));
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


	private static $pricing_data = [];

	public static function get_all()
	{

		if(empty(self::$pricing_data))
		{
			$pricing = self::convert_csv_to_json();

			if(!is_array($pricing))
			{
				$pricing = [];
			}

			self::$pricing_data = $pricing;
		}


		return self::$pricing_data;
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
								$pricing[$value['domain']]['price1'] = $pricing[$value['domain']]['price'];
								if(a($value, '2 years')) { 	$pricing[$value['domain']]['price2'] = self::toman_price($value['2 years'], substr($value['domain'], 1)); }
								if(a($value, '3 years')) { 	$pricing[$value['domain']]['price3'] = self::toman_price($value['3 years'], substr($value['domain'], 1)); }
								if(a($value, '4 years')) { 	$pricing[$value['domain']]['price4'] = self::toman_price($value['4 years'], substr($value['domain'], 1)); }
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


	public static function domain_price($_type = null, $_currency = null)
	{
		$priceList = [];
		$dir = __DIR__. '/pricing.csv';
		if(is_file($dir))
		{
			$priceList = \dash\utility\import::csv($dir);
		}

		if(!is_array($priceList))
		{
			return null;
		}

		// add foreach to add extra 2.9% fee of transfer
		// and maybe some other changes
		$filteredPrice = [];
		$forbiddenTLD = [
			// and remove forbidden tld
			'.adult',
			'.xxx',
			'.porn',
			'.sex',
			'.sexy',
			'.bet',
			'.casino',
			'.dating',
			'.wine',

			// and remove tld with paper
			'.de',

			// and remove expensive tld
			// $ 2399
			'.auto',
			'.car',
			'.cars',
			'.protection',
			'.security',
			// $ 1859
			'.lotto',
			// $ 589
			'.theatre',
			// $ 389
			'.tickets',
			// $ 360.99
			'.hosting',
			'.juegos',
			// $ 349
			'.game',
			// $ 289
			'.movie',
			// $ 189
			'.aaa.pro',
			'.aca.pro',
			'.acct.pro',
			'.avocat.pro',
			'.bar.pro',
			'.cpa.pro',
			'.eng.pro',
			'.jur.pro',
			'.law.pro',
			'.med.pro',
			'.recht.pro',
			// $ 120.99
			'.audio',
			'.blackfriday',
			'.guitars',
			'.hiphop',
			'.property',
			'.creditcard',
			// $ 88.99
			'.ag',
			// $ 84.99
			'.sc',
			// less than 100$ is okay

			// 3 level domains
			'.co.ag',
			'.com.ag',
			'.net.ag',
			'.nom.ag',
			'.org.ag',
			'.ac.vn',
			'.com.vc',
			'.edu.vn',
			'.gov.vn',
			'.health.vn',
			'.info.vn',
			'.int.vn',
			'.name.vn',
			'.net.vc',
			'.net.vn',
			'.org.vc',
			'.org.vn',
			'.pro.vn',
			'.com.co',
			'.net.co',
			'.nom.co',
			'.com.tw',
			'.net.tw',
			'.org.tw',
			'.co.lc',
			'.com.lc',
			'.l.lc',
			'.net.lc',
			'.org.lc',
			'.p.lc',
			'.co.uk',
			'.ltd.uk',
			'.me.uk',
			'.net.uk',
			'.org.uk',
			'.plc.uk',
			'.*.name',
			'.co.in',
			'.firm.in',
			'.gen.in',
			'.ind.in',
			'.net.in',
			'.org.in',


		];

		foreach ($priceList as $key => $value)
		{
			$tldPrice = [];
			if(isset($value['domain']) && $value['domain'])
			{
				if(in_array($value['domain'], $forbiddenTLD))
				{
					continue;
				}
				$tldPrice['domain'] = $value['domain'];
			}
			else
			{
				continue;
			}
			if(isset($value['type']) && $value['type'])
			{
				if($_type)
				{
					if($_type === $value['type'])
					{
						$tldPrice['type'] = $value['type'];
					}
					else
					{
						continue;
					}
				}
				else
				{
					$tldPrice['type'] = $value['type'];
				}
			}
			else
			{
				continue;
			}

			// price for 10 year
			for ($i=1; $i <= 10; $i++)
			{
				$name = $i. ' years';
				if($i === 1)
				{
					$name = $i. ' year';
				}
				if(isset($value[$name]))
				{
					$extraFee = self::wage() + self::profit($value['domain']) + 0.1 ;
					$extraFee = 1 + ( $extraFee / 100 );

					$tldPrice[$name] = round($value[$name] * $extraFee, 2);
					if($_currency === 'IRT')
					{
						// exchange
						$exchangedPrice = round($tldPrice[$name] * self::dollar(), -3);
						// remove 3 zero
						$exchangedPrice = $exchangedPrice / 1000;
						$tldPrice[$name] = $exchangedPrice;
					}
				}
			}

			$filteredPrice[] = $tldPrice;
		}

		// add ir domains
		$finalDataList = array_merge($filteredPrice, self::irDomainPrice($_currency));

		return $finalDataList;
	}


	public static function price_table($_type = null, $_currency = null, $_year = '1 year')
	{
		$priceList = self::domain_price($_type, $_currency);
		$priceTable = [];

		foreach ($priceList as $key => $value)
		{
			$tld = null;
			$type = null;
			if(isset($value['domain']) && $value['domain'])
			{
				$tld = $value['domain'];
				$priceTable[$tld]['TLD'] = $tld;
			}
			if(isset($value['type']))
			{
				switch ($value['type'])
				{
					case 'domainregister':
						$type = 'register';
						break;

					case 'domainrenew':
						$type = 'renew';
						break;

					case 'domaintransfer':
						$type = 'transfer';
						break;

					default:
						break;
				}
			}

			$priceTable[$tld]['duration'] = intval(trim(substr($_year, 0, 2)));
			if(isset($value[$_year]) && $value[$_year])
			{
				$priceTable[$tld][$type] = $value[$_year];
			}
		}

		return $priceTable;
	}


	private static function irDomainPrice($_currency = null)
	{
		$irDomainList = [
			'.ir',
			'.id.ir',
			'.co.ir',
			'.ac.ir',
			'.sch.ir',
			'.net.ir',
			'.org.ir',
			'.gov.ir',
		];
		$irDomainType = ['domainregister', 'domainrenew', 'domaintransfer'];
		$irPriceList = [];

		$ir1yr = 0.99;
		$ir5yr = 2.99;
		if($_currency === 'IRT')
		{
			$ir1yr = \lib\app\nic_domain\price::register('1year') / 1000;
			$ir5yr = \lib\app\nic_domain\price::register('5year') / 1000;
		}

		foreach ($irDomainList as $tld)
		{
			foreach ($irDomainType as  $type)
			{

				$thisTLD =
				[
					'domain'  => $tld,
					'type'    => $type,
					'1 year'  => $ir1yr,
					'5 years' => $ir5yr,
				];

				$irPriceList[] = $thisTLD;
			}
		}

		return $irPriceList;
	}

}
?>