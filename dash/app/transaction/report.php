<?php
namespace dash\app\transaction;

class report
{


	public static function income_monthly()
	{
		$result = [];

		$result['chart'] = self::chart();
		$result['table'] = null;
		return $result;
	}



	private static function chart()
	{

		$last_12_month = date("Y-m-d H:i:s", strtotime("-365 days"));

		$month_list = [];
		$category = [];

		if(\dash\language::current() === 'fa')
		{
			for ($i=0; $i < 12 ; $i++)
			{
				// stard date on gregorian month must be plus 2 days and the convert to jalali month !
				$month_time = strtotime("-$i month") + (60*60*24*2);

				$jalali_month = \dash\utility\jdate::date("m", $month_time, false);

				list($startdate, $enddate) = \dash\utility\jdate::jalali_month(\dash\utility\jdate::date("Y", strtotime("-$i month"), false), $jalali_month);

				$all_date[$jalali_month]   = [$startdate, $enddate];
				$month_list[$jalali_month] = 0;
				$category[] = \dash\utility\jdate::date("F", $month_time);
			}

			$plus_transaction = \dash\db\transactions\get::chart_by_date_fa($last_12_month, $all_date);
			$minus_transaction   = \dash\db\transactions\get::chart_by_date_fa($last_12_month, $all_date);

		}
		else
		{
			$plus_transaction = \dash\db\transactions\get::chart_by_date_en($last_12_month);
			$minus_transaction   = \dash\db\transactions\get::chart_by_date_en($last_12_month);

			for ($i=0; $i < 12 ; $i++)
			{
				$month_list[date("m", strtotime("-$i month"))] = 0;
				$category[] = date("F", strtotime("-$i month"));
			}

		}


		if(!is_array($plus_transaction))
		{
			$plus_transaction = [];
		}

		if(!is_array($minus_transaction))
		{
			$minus_transaction = [];
		}


		$month_list_plus = $month_list;
		$month_list_minus   = $month_list;

		foreach ($minus_transaction as $key => $value)
		{
			if(isset($value['month']) && isset($month_list_plus[$value['month']]))
			{
				$month_list_plus[$value['month']] = floatval($value['sum_plus']);
			}
		}


		foreach ($minus_transaction as $key => $value)
		{
			if(isset($value['month']) && isset($month_list_minus[$value['month']]))
			{
				$month_list_minus[$value['month']] = floatval($value['sum_minus']);
			}
		}





		$chart             = [];
		$chart['category'] = json_encode($category , JSON_UNESCAPED_UNICODE);
		$chart['plus']     = json_encode(array_values($month_list_plus), JSON_UNESCAPED_UNICODE);
		$chart['minus']    = json_encode(array_values($month_list_minus), JSON_UNESCAPED_UNICODE);

		return $chart;
	}
}
?>