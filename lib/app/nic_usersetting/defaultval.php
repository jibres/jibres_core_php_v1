<?php
namespace lib\app\nic_usersetting;


class defaultval
{

	public static function autorenewperiod()
	{
		return '5year';
	}


	public static function domainlifetime()
	{
		return '1month';
	}


	public static function ns1()
	{
		return 'w.ns.arvancdn.com';
	}


	public static function ns2()
	{
		return 'f.ns.arvancdn.com';
	}


	public static function get_time($_key)
	{
		$time = 0;
		switch ($_key)
		{
			case '3day':
				$time = (60*60*24*3);
				break;

			case '1week':
				$time = (60*60*24*7);
				break;

			case '1month':
				$time = (60*60*24*30);
				break;

			case '6month':
				$time = (60*60*24*30*6);
				break;

			case '1year':
				$time = (60*60*24*30*12);
				break;

		}

		return $time;
	}



	public static function user_autorenewperiod($_user_id)
	{
		$get_setting = \lib\db\nic_usersetting\get::my_setting($_user_id);

		if(isset($get_setting['autorenewperiod']))
		{
			$autorenewperiod = $get_setting['autorenewperiod'];
		}
		else
		{
			$autorenewperiod = self::autorenewperiod();
		}

		return $autorenewperiod;
	}
}
?>