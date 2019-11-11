<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		if(\dash\url::subdomain() !== 'source')
		{
			$sourceURL = \dash\url::protocol(). '://source.'. \dash\url::domain(). \dash\url::path();

			\dash\redirect::to($sourceURL);
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>