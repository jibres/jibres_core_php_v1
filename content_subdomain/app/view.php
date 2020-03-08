<?php
namespace content_subdomain\app;


class view
{
	public static function config()
	{
		$app_queue = \lib\app\application\queue::detail();

		if(isset($app_queue['status']) && $app_queue['status'] === 'done' && isset($app_queue['file']))
		{
			$host = \dash\url::cloud();
			$host .= '/'. \dash\store_coding::encode();
			$host .= '/app/'. basename($app_queue['file']);
			\dash\redirect::to($host, true , 302);
		}

		\dash\redirect::to(\dash\url::kingdom());
	}
}
?>
