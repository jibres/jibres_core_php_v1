<?php

namespace lib\app\sms;


class dashboard
{

	public static function get()
	{
		$result                                   = [];
		$result['countall']                       = \lib\db\sms\get::count_all();
		$result['countallsending']                = \lib\db\sms\get::count_all_sending();
		$result['countallcharge']                 = \lib\db\sms_charge\get::count_all();
		$result['totalcharge']                    = \lib\db\sms_charge\get::total_charge();
		$result['avgcharge']                      = \lib\db\sms_charge\get::avg_charge();
		$result['totalspent']                     = \lib\db\sms\get::total_spent();
		$result['totalrealspent']                 = \lib\db\sms\get::total_real_spent();
		$result['countbusinesscharge']            = \lib\db\sms_charge\get::count_business();
		$result['kavenegarjibressmspanelcharge']  = rand();
		$result['kavenegarbusinessmspanelcharge'] = rand();
		$result['smsperstatus']                   = \lib\db\sms\get::count_by_status();

		return $result;
	}

}
