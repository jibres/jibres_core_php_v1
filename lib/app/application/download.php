<?php
namespace lib\app\application;


class download
{



	public static function from_site()
	{
		$app_queue = \lib\app\application\queue::detail();

		if(isset($app_queue['status']) && $app_queue['status'] === 'done' && isset($app_queue['file']))
		{
			self::save_download_log($app_queue);

			$host = \dash\url::cloud();
			$host .= '/'. \dash\store_coding::encode_raw();
			$host .= '/app/'. basename($app_queue['file']);
			\dash\redirect::to($host, true , 302);

		}
		else
		{
			\dash\redirect::to(\dash\url::kingdom());
		}
	}




	private static function save_download_log($_app_detail)
	{

		$insert                 = [];
		$insert['os']           = 'android';
		$insert['version']      = (isset($_app_detail['version']) && is_numeric($_app_detail['version']) )? intval($_app_detail['version']) : null;
		$insert['build']        = (isset($_app_detail['build']) && is_numeric($_app_detail['build']) )? intval($_app_detail['build']) : null;
		$insert['user_id']      = \dash\user::id();
		$insert['datedownload'] = date("Y-m-d H:i:s");

		// save ip id
		$insert['ip_id']    = \dash\utility\ip::id();

		// save agent id
		$insert['agent_id'] = \dash\agent::get(true);

		\lib\db\app_download\insert::new_record($insert);
	}



	public static function chart()
	{
		$download_chart = \lib\db\app_download\get::chart_all();

		$temp      = [];
		$temp_all  = [];
		$count_all = 0;

		if(is_array($download_chart))
		{
			foreach ($download_chart as $key => $value)
			{
				$count      = intval($value['count']);
				$count_all  += $count;
				$temp[]     = ['key' => \dash\fit::date($value['datedownload']), 'count' => intval($count)];
				$temp_all[] = ['key' => \dash\fit::date($value['datedownload']), 'count' => intval($count_all)];
			}
		}

		$hi_chart               = [];
		$hi_chart['categories'] = json_encode(array_column($temp, 'key'), JSON_UNESCAPED_UNICODE);
		$hi_chart['count']      = json_encode(array_column($temp, 'count'), JSON_UNESCAPED_UNICODE);
		$hi_chart['count_all']  = json_encode(array_column($temp_all, 'count'), JSON_UNESCAPED_UNICODE);

		return $hi_chart;
	}



	public static function stat()
	{
		$last_week  = date("Y-m-d H:i:s", strtotime("-7 days"));
		$last_month = date("Y-m-d H:i:s", strtotime("-30 days"));
		$last_year  = date("Y-m-d H:i:s", strtotime("-365 days"));

		$result                           = [];
		$result['totalDownload']          = intval(\lib\db\app_download\get::count_all());
		$result['totalDownloadLastWeek']  = intval(\lib\db\app_download\get::count_from_date($last_week));
		$result['totalDownloadLastMonth'] = intval(\lib\db\app_download\get::count_from_date($last_month));
		$result['totalDownloadLastYear']  = intval(\lib\db\app_download\get::count_from_date($last_year));
		return $result;
	}

}
?>