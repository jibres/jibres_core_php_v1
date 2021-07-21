<?php
namespace lib\app\tax\doc;


class dashboard
{

	public static function detail()
	{
		$result                         = [];
		$result['chart']                = self::report_monthly();

		$default_year_id                = \lib\app\tax\year\get::default_year('id');

		$result['factor_type']          = \lib\db\tax_document\get::count_group_by_template($default_year_id);
		$result['count_all_doc']        = floatval(\lib\db\tax_document\get::count_all_doc($default_year_id));
		$result['count_all_locked']     = floatval(\lib\db\tax_document\get::count_all_doc_lock($default_year_id));
		$result['count_all_attachment'] = floatval(\lib\db\tax_document\get::count_all_doc_with_attachment($default_year_id));
		$result['count_all_coding']     = floatval(\lib\db\tax_coding\get::count_all());
		$result['count_all_year']       = floatval(\lib\db\tax_year\get::count_all());

		$div = $result['count_all_doc'];
		if(!$div)
		{
			$div = 1;
		}


		$result['percent_lock'] = round(($result['count_all_locked'] * 100) / $div);
		$result['percent_attachment'] = round(($result['count_all_attachment'] * 100) / $div);

		return $result;

	}




	public static function report_monthly()
	{

		$default_year = \lib\app\tax\year\get::default_year();

		$month_count = 12;
		if(isset($default_year['startdate']))
		{
			$start_year = $default_year['startdate'];
			$endyear   = $default_year['enddate'];
		}
		else
		{
			$start_year = date("Y-m-d", strtotime("-365 days"));
			$endyear   = date("Y-m-d");
		}


		$month_list = [];
		$category = [];

		$firstday = date('Y-m-25', strtotime($start_year));

		if(\dash\language::current() === 'fa')
		{
			for ($i=0; $i < $month_count ; $i++)
			{
				$month_time = strtotime("+$i month", strtotime($firstday));
				$jalali_month = \dash\utility\jdate::date("m", $month_time, false);

				list($startdate, $enddate) = \dash\utility\jdate::jalali_month(\dash\utility\jdate::date("Y", $month_time, false), $jalali_month);

				$new_key = \dash\utility\jdate::date("Y", $month_time, false). '-'. $jalali_month;

				$all_date[$new_key]   = [$startdate, $enddate];
				$month_list[$new_key] = 0;
				$category[]           = \dash\utility\jdate::date("Y F", $month_time);
			}


			$data = \lib\db\tax_document\get::chart_by_date_fa($start_year, $endyear, $all_date);

		}
		else
		{
			$data = \lib\db\tax_document\get::chart_by_date_en($start_year, $endyear);
			for ($i=0; $i < $month_count ; $i++)
			{
				$month_list[date("Y-m", strtotime("-$i month"))] = 0;
				$category[] = date("Y F", strtotime("-$i month"));
			}
		}


		if(!is_array($data))
		{
			$data = [];
		}


		foreach ($data as $key => $value)
		{
			if(isset($value['count']))
			{
				$data[$key]['count'] = floatval($value['count']);
			}
		}


		$chart             = [];
		$chart['category'] = json_encode($category , JSON_UNESCAPED_UNICODE);
		$chart['count']    = json_encode(array_column($data, 'count'), JSON_UNESCAPED_UNICODE);

		return $chart;
	}
}
?>
		