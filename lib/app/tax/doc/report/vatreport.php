<?php
namespace lib\app\tax\doc\report;


class vatreport
{
	public static function get()
	{

		$year_detail = \lib\app\tax\year\get::default_year();

		$remainvatlastyear = floatval(a($year_detail, 'remainvatlastyear'));

		$vatsetting = a($year_detail, 'vatsetting');

		if(!is_array($vatsetting))
		{
			$vatsetting = [];
		}

		$startdate = a($year_detail, 'startdate');
		$enddate   = a($year_detail, 'enddate');

		$myYear = \dash\utility\convert::to_en_number(\dash\fit::date(date("Y-m-d", strtotime($startdate))));
		$myYear = substr($myYear, 0, 4);

		$quarter = [];

		$quarter[1] = ["$myYear-01-01", "$myYear-03-31"];
		$quarter[2] = ["$myYear-04-01", "$myYear-06-31"];
		$quarter[3] = ["$myYear-07-01", "$myYear-09-30"];
		$quarter[4] = ["$myYear-10-01", "$myYear-12-30"];

		$args = [];
		$args['summary_mode'] = true;

		$result = [];
		foreach ($quarter as $key => $value)
		{
			$temp              = [];
			$temp['quarter']   = $key;
			$temp['startdate'] = $args['startdate'] = $value[0];
			$temp['enddate']   = $args['enddate']   = $value[1];

			$list = [];

			// income
			{
				$args['template'] = 'income';

				$list['income']   = \lib\app\tax\doc\search::list(null, $args);
			}

			// cost + asset
			{
				$args['template'] = 'costasset';

				$list['cost']     = \lib\app\tax\doc\search::list(null, $args);
			}

			$current_remain = floatval(a($list, 'income', 'totalincludevat')) - floatval(a($list, 'cost', 'totalincludevat'));

			$temp['current_remainvat6'] = round($current_remain * 0.06);
			$temp['current_remainvat3'] = round($current_remain * 0.03);

			$remain = $current_remain;
			$last_remain = 0;

			if($key === 1)
			{
				$last_remain = $remainvatlastyear;
				$remain = $remain + $remainvatlastyear;
			}
			else
			{
				if(a($vatsetting, $key - 1, 'decide') === 'move') // get from setting
				{
					$last_remain = a($result, $key - 1, 'remain');
					$remain = $remain  + $last_remain;
				}
			}

			$temp['remain'] = $remain;
			$temp['remainvat6'] = round($remain * 0.06);
			$temp['remainvat3'] = round($remain * 0.03);


			$temp['last_remain'] = $last_remain;
			$temp['last_remainvat6'] = round($last_remain * 0.06);
			$temp['last_remainvat3'] = round($last_remain * 0.03);


			$result[$key] = array_merge($temp, $list);
		}


		return $result;
	}
}
?>