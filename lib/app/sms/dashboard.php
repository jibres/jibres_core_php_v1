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
		$result['chart']                   = self::chart();

		return $result;
	}


	private static function chart()
	{
		$data = \lib\db\sms\get::adminChart();

		$categories = [];
		$plan       = array_column($data, 'status');
		$plan       = array_filter($plan);
		$plan       = array_unique($plan);

		$clone = [];
		foreach ($plan as $onePlan)
		{
			$clone[$onePlan] = 0;
		}

		$series = [];

		foreach ($data as $value)
		{
			if(!in_array($value['categories'], $categories))
			{
				$categories[]                 = $value['categories'];
				$series[$value['categories']] = $clone;
			}

			$series[$value['categories']][$value['status']] = $value['count'];

		}

		$newSeries = [];

		foreach ($plan as $onePlan)
		{
			$newSeries[] =
				[
					'name' => T_(ucfirst($onePlan)),
					'data' => array_column($series, $onePlan),
				];
		}

		$chart               = [];
		$chart['categories'] = json_encode(array_map(['\\dash\\fit', 'date'], $categories));
		$chart['series']     = json_encode($newSeries);
		return $chart;

	}
}
