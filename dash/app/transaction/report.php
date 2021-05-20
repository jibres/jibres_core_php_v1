<?php
namespace dash\app\transaction;

class report
{


	public static function income_monthly()
	{

		$first_verify_transaction = \dash\db\transactions\get::first_verify_transaction();

		if(isset($first_verify_transaction['date']))
		{
			$datetime1 = date_create($first_verify_transaction['date']);
			$datetime2 = date_create(date("Y-m-d"));
			$interval  = date_diff($datetime1, $datetime2);

			$month_count =  $interval->m + ($interval->y * 12) + 2;

			if(intval($month_count) < 12)
			{
				$month_count = 12;
			}

			$last_12_month = $first_verify_transaction['date'];
		}
		else
		{

			$month_count = 12;
			$last_12_month = date("Y-m-d H:i:s", strtotime("-365 days"));
		}

		$month_list = [];
		$category = [];

		$today = date('Y-m-02 00:00:00');

		if(\dash\language::current() === 'fa')
		{
			for ($i=0; $i < $month_count ; $i++)
			{
				$month_time = strtotime("-$i month", strtotime($today));
				$jalali_month = \dash\utility\jdate::date("m", $month_time, false);

				list($startdate, $enddate) = \dash\utility\jdate::jalali_month(\dash\utility\jdate::date("Y", $month_time, false), $jalali_month);

				$new_key = \dash\utility\jdate::date("Y", $month_time, false). '-'. $jalali_month;

				$all_date[$new_key]   = [$startdate, $enddate];
				$month_list[$new_key] = 0;
				$category[]           = \dash\utility\jdate::date("Y F", $month_time);
			}


			$plus_transaction = \dash\db\transactions\get::chart_by_date_fa($last_12_month, $all_date);

		}
		else
		{
			$plus_transaction = \dash\db\transactions\get::chart_by_date_en($last_12_month);


			for ($i=0; $i < $month_count ; $i++)
			{
				$month_list[date("Y-m", strtotime("-$i month"))] = 0;
				$category[] = date("Y F", strtotime("-$i month"));
			}


		}


		if(!is_array($plus_transaction))
		{
			$plus_transaction = [];
		}



		$month_list_plus = $month_list;
		$month_list_minus   = $month_list;

		foreach ($plus_transaction as $key => $value)
		{
			if(isset($value['month']) && isset($month_list_plus[$value['month']]))
			{
				$month_list_plus[$value['month']] = floatval($value['sum_plus']);
			}
		}


		foreach ($plus_transaction as $key => $value)
		{
			if(isset($value['month']) && isset($month_list_minus[$value['month']]))
			{
				$month_list_minus[$value['month']] = floatval($value['sum_minus']);
			}
		}



		$chart                = [];
		$chart['category']    = json_encode($category , JSON_UNESCAPED_UNICODE);
		$chart['plus']        = json_encode(array_values($month_list_plus), JSON_UNESCAPED_UNICODE);
		$chart['minus']       = json_encode(array_values($month_list_minus), JSON_UNESCAPED_UNICODE);
		$chart['plus_table']  = $month_list_plus;
		$chart['minus_table'] = $month_list_minus;
		return $chart;
	}
}
?>