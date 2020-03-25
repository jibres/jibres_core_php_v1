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
			$host .= '/'. \dash\store_coding::encode();
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

		\lib\db\app_download\insert::new_record($insert);
	}

}
?>