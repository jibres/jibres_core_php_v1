<?php
namespace content_b1;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();

		// load appkey if exist
		// load apikey if exist
		// check not loaded store
		\content_b1\tools::master_check();
	}


	private static function check_subdomain_and_content()
	{
		$subdomain = \dash\url::subdomain();

		// replace business form content to subdomain
		if($subdomain === null)
		{
			$newCoreAddress = \dash\url::api('business');

			if(\dash\url::path())
			{
				$newCoreAddress .= \dash\url::path();
			}
			\dash\redirect::to($newCoreAddress);
		}

		if($subdomain !== 'business')
		{
			\dash\header::status(404, T_("Invalid subdomain. remove subdomain to continue"));
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>