<?php
namespace content_api\v2\android;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::directory() === 'v2/android/user/add' && \dash\request::is('post'))
		{
			\content_api\v2\android\user\add::add();
		}
		elseif(\dash\url::subchild())
		{
			\content_api\v2::invalid_url();
		}

		$detail = self::detail();

		\content_api\v2::say($detail);
	}

	private static function detail()
	{
		$detail            = [];
		$detail['version'] = '1.1.1';

		$detail['lang_list'] = \dash\language::all();

		if(is_callable(["\\lib\\app\\android", "detail_v2"]))
		{
			$my_detail = \lib\app\android::detail_v2();
			if(is_array($my_detail))
			{
				$detail = array_merge($detail, $my_detail);
			}
		}

		return $detail;
	}
}
?>