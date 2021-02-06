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
		$dashboard_detail['avg_seorank']       = floatval(\dash\db\posts::avg_seorank());
		$star = round(($dashboard_detail['avg_seorank'] * 5 / 100), 1);
		$dashboard_detail['seostar_html']      = \dash\seo::star_html($star);


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


	public static function seo()
	{
		$seo_dashboard                      = [];

		$seo_dashboard['avg_seorank']       = floatval(\dash\db\posts::avg_seorank());
		$seo_dashboard['seostar_html']      = \dash\seo::star_html(round(($seo_dashboard['avg_seorank'] * 5 / 100), 1));
		return $seo_dashboard;
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

			$get_detail_publish = \dash\db\posts\get::chart_by_date_fa($last_12_month, $all_date, 'publish');
			$get_detail_draft   = \dash\db\posts\get::chart_by_date_fa($last_12_month, $all_date, 'draft');

		}
		else
		{
			$get_detail_publish = \dash\db\posts\get::chart_by_date_en($last_12_month, 'publish');
			$get_detail_draft   = \dash\db\posts\get::chart_by_date_en($last_12_month, 'draft');

			for ($i=0; $i < 12 ; $i++)
			{
				$month_list[date("m", strtotime("-$i month"))] = 0;
				$category[] = date("F", strtotime("-$i month"));
			}

		}


		if(!is_array($get_detail_publish))
		{
			$get_detail_publish = [];
		}

		if(!is_array($get_detail_draft))
		{
			$get_detail_draft = [];
		}


		$month_list_publish = [];
		$month_list_draft   = [];

		foreach ($month_list as $key => $value)
		{
			if(isset($get_detail_publish[$key]))
			{
				$month_list_publish[$key] = floatval($get_detail_publish[$key]);
			}
			else
			{
				$month_list_publish[$key] = floatval(0);
			}

			if(isset($get_detail_draft[$key]))
			{
				$month_list_draft[$key] = floatval($get_detail_draft[$key]);
			}
			else
			{
				$month_list_draft[$key] = floatval(0);
			}
		}



		$chart                = [];
		$chart['category']    = json_encode($category , JSON_UNESCAPED_UNICODE);
		$chart['datapublish'] = json_encode(array_values($month_list_publish), JSON_UNESCAPED_UNICODE);
		$chart['datadraft']   = json_encode(array_values($month_list_draft), JSON_UNESCAPED_UNICODE);

		return $chart;
	}

}
?>