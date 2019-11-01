<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		if(\dash\url::subdomain() !== 'source')
		{
			\dash\redirect::remove_subdomain();
		}
		// save api log
		\dash\app\apilog::start();
	}
}
?>