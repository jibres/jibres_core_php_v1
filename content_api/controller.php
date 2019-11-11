<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		if(!in_array(\dash\url::subdomain(), ['source', 'store', null]))
		{
			\dash\header::status(404, T_("Invalid api subdomain. remove subdomain to continue"));
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>