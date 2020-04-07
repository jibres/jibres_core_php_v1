<?php
namespace content_r10;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();

		// load appkey if exist
		// load apikey if exist
		// check not loaded store
		\content_r10\tools::master_check();
	}


	private static function check_subdomain_and_content()
	{
		$subdomain = \dash\url::subdomain();

		// replace core form content to subdomain
		if($subdomain === null)
		{
			$newCoreAddress = \dash\url::set_subdomain('core');

			if(\dash\url::path())
			{
				$newCoreAddress .= \dash\url::path();
			}
			\dash\redirect::to($newCoreAddress);
		}

		if($subdomain !== 'core')
		{
			\dash\header::status(404, T_("Invalid subdomain. remove subdomain to continue"));
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>