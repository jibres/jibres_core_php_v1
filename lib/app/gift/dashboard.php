<?php
namespace lib\app\gift;

class dashboard
{

	public static function detail()
	{
		$result               = [];

		$result['all']         = floatval(\lib\db\gift\get::count_all());
		$result['active']      = floatval(\lib\db\gift\get::count_active());
		$result['expired']     = floatval(\lib\db\gift\get::count_expired());
		$result['lookup']      = floatval(\lib\db\giftlookup\get::count_lookup());
		$result['lookupfaild'] = floatval(\lib\db\giftlookup\get::count_lookupfaild());
		$result['usage']       = floatval(\lib\db\giftusage\get::count_usage());


		$result['lastusage'] = \lib\app\gift\usage\search::last_5_usage();
		$result['lastlookup'] = \lib\app\gift\lookup\search::last_5_lookup();

		$result['chart'] = self::chart();

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

			$get_detail_ticket = \dash\db\tickets\get::chart_by_date_fa($last_12_month, $all_date, false);
			$get_detail_message   = \dash\db\tickets\get::chart_by_date_fa($last_12_month, $all_date, true);

		}
		else
		{
			$get_detail_ticket = \dash\db\tickets\get::chart_by_date_en($last_12_month, false);
			$get_detail_message   = \dash\db\tickets\get::chart_by_date_en($last_12_month, false);

			for ($i=0; $i < 12 ; $i++)
			{
				$month_list[date("m", strtotime("-$i month"))] = 0;
				$category[] = date("F", strtotime("-$i month"));
			}

		}


		if(!is_array($get_detail_ticket))
		{
			$get_detail_ticket = [];
		}

		if(!is_array($get_detail_message))
		{
			$get_detail_message = [];
		}


		$month_list_ticket = [];
		$month_list_message   = [];

		foreach ($month_list as $key => $value)
		{
			if(isset($get_detail_ticket[$key]))
			{
				$month_list_ticket[$key] = floatval($get_detail_ticket[$key]);
			}
			else
			{
				$month_list_ticket[$key] = floatval(0);
			}

			if(isset($get_detail_message[$key]))
			{
				$month_list_message[$key] = floatval($get_detail_message[$key]);
			}
			else
			{
				$month_list_message[$key] = floatval(0);
			}
		}



		$chart                = [];
		$chart['category']    = json_encode($category , JSON_UNESCAPED_UNICODE);
		$chart['dataticket'] = json_encode(array_values($month_list_ticket), JSON_UNESCAPED_UNICODE);
		$chart['datamessage']   = json_encode(array_values($month_list_message), JSON_UNESCAPED_UNICODE);

		return $chart;
	}
}
?>