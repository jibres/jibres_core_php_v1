<?php
namespace dash\app\posts;

class dashboard
{

	public static function detail()
	{

		$total_post = floatval(\dash\db\posts::get_active_count());

		$dashboard_detail                      = [];

		$dashboard_detail['post']              = $total_post;

		$dashboard_detail['standard']          = floatval(\dash\db\posts::get_active_count_subtype('standard'));
		$dashboard_detail['gallery']           = floatval(\dash\db\posts::get_active_count_subtype('gallery'));
		$dashboard_detail['video']             = floatval(\dash\db\posts::get_active_count_subtype('video'));
		$dashboard_detail['audio']             = floatval(\dash\db\posts::get_active_count_subtype('audio'));

		$dashboard_detail['comments']          = floatval(\dash\db\comments::get_count());
		$dashboard_detail['comments_awaiting'] = floatval(\dash\db\comments::get_count(['status' => 'awaiting']));
		$dashboard_detail['comments_approved'] = floatval(\dash\db\comments::get_count(['status' => 'approved']));

		$dashboard_detail['files']             = floatval(\dash\db\files::count_all());
		//
		$dashboard_detail['tags']              = floatval(\dash\db\terms\get::get_count(['type' => 'tag']));
		$dashboard_detail['latesPost']         = \dash\app\posts\search::lates_post();
		$dashboard_detail['latesComment']      = \dash\app\comment\search::lates_comment();

		if(!$total_post)
		{
			$total_post = 1;
		}

		$specialaddress_percent = floatval(\dash\db\posts::get_count_special_address());
		$specialaddress_percent = round(($specialaddress_percent * 100) / $total_post);

		$havecover_percent      = floatval(\dash\db\posts::get_count_have_cover());
		$havecover_percent      = round(($havecover_percent * 100) / $total_post);

		$publish_percent        = floatval(\dash\db\posts::get_count_published());
		$publish_percent        = round(($publish_percent * 100) / $total_post);


		$dashboard_detail['specialaddress_percent'] = $specialaddress_percent;
		$dashboard_detail['havecover_percent']      = $havecover_percent;
		$dashboard_detail['publish_percent']        = $publish_percent;

		$dashboard_detail['chart']        = self::chart();


		return $dashboard_detail;




	}




	private static function chart()
	{

		$last_12_month = date("Y-m-d", strtotime("-365 days"));

		$month_list = [];
		$category = [];

		if(\dash\language::current() === 'fa')
		{
			for ($i=0; $i < 12 ; $i++)
			{
				$jalali_month = \dash\utility\jdate::date("m", strtotime("-$i month"), false);

				list($startdate, $enddate) = \dash\utility\jdate::jalali_month(\dash\utility\jdate::date("Y", strtotime("-$i month"), false), $jalali_month);

				$all_date[$jalali_month]   = [$startdate, $enddate];
				$month_list[$jalali_month] = 0;
				$category[] = \dash\utility\jdate::date("F", strtotime("-$i month"));
			}

			$get_detail   = \dash\db\posts\get::chart_by_date_fa($last_12_month, $all_date);

		}
		else
		{
			$get_detail   = \dash\db\posts\get::chart_by_date_en($last_12_month);

			for ($i=0; $i < 12 ; $i++)
			{
				$month_list[date("m", strtotime("-$i month"))] = 0;
				$category[] = date("F", strtotime("-$i month"));
			}

		}

		if(!is_array($get_detail))
		{
			$get_detail = [];
		}



		foreach ($get_detail as $key => $value)
		{
			if(isset($month_list[$value['month']]))
			{
				$month_list[$value['month']] = floatval($value['count']);
			}
		}

		$chart             = [];
		$chart['category'] = json_encode($category , JSON_UNESCAPED_UNICODE);
		$chart['data']   = json_encode(array_values($month_list), JSON_UNESCAPED_UNICODE);

		return $chart;
	}

}
?>