<?php
namespace lib\app\tax\doc\report;


class vatreport
{
	public static function get($_year_detail)
	{
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

			$list              = \lib\app\tax\doc\search::list(null, $args);

			$result[] = array_merge($temp, $list);
		}

		return $result;
	}
}
?>