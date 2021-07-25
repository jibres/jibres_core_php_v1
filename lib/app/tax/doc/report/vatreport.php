<?php
namespace lib\app\tax\doc\report;


class vatreport
{
	public static function get($_year_detail)
	{
		$remainvatlastyear = floatval(a($_year_detail, 'remainvatlastyear'));

		$vatsetting = a($_year_detail, 'vatsetting');
		if(!is_string($vatsetting))
		{
			$vatsetting = json_decode($vatsetting, true);
		}

		if(!is_array($vatsetting))
		{
			$vatsetting = [];
		}

		$startdate = a($_year_detail, 'startdate');
		$enddate   = a($_year_detail, 'enddate');

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


			$result[$key] = array_merge($temp, $list);
		}

		// var_dump($result);exit;

		return $result;
	}
}
?>