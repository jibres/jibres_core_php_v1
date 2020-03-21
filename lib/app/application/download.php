<?php
namespace lib\app\application;


class download
{



	public static function site()
	{
		self::find_in_jibres_db();
		// @todo
		// @reza
		return;
		if(!self::find_in_file())
		{
			if(!self::find_in_setting())
			{
				self::find_in_jibres_db();
			}
			else
			{
				self::save_file();
			}
		}
	}


	private static function find_in_setting()
	{

	}


	private static function find_in_file()
	{
		$app_json_detail = YARD . 'talambar_cloud/'. \dash\store_coding::encode_raw() . '/app/detail.json';
		j($app_json_detail);
		if(is_file($app_json_detail))
		{
			$app_json_detail = json_decode(\dash\file::read($app_json_detail), true);
			if(!is_array($app_json_detail))
			{
				return false;
			}

			return self::redirect_to_app($app_json_detail);
		}
		else
		{
			return false;
		}
	}


	private static function redirect_to_app($_app_detail)
	{
		if(isset($_app_detail['file']) && $_app_detail['file'] && is_string($_app_detail['file']))
		{
			$host = \dash\url::cloud();
			$host .= '/'. \dash\store_coding::encode();
			$host .= '/app/'. basename($_app_detail['file']);
			\dash\redirect::to($host, true , 302);
		}
		else
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

	}



	/**
	 * Finds application record in jibres database.
	 */
	private static function find_in_jibres_db()
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