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
			$host .= '/'. \lib\store::code();
			$host .= '/app/'. basename($app_queue['file']);
			\dash\redirect::to($host);
		}

		\dash\redirect::to(\dash\url::this());
	}
}
?>
