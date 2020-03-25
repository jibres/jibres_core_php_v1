<?php
namespace content_r10;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();
	}


	private static function check_subdomain_and_content()
	{
		// replace core form content to subdomain
		if(\dash\url::subdomain() === null)
		{
			$newCoreAddress = \dash\url::set_subdomain('core');

			if(\dash\url::path())
			{
				$newCoreAddress .= \dash\url::path();
			}
			\dash\redirect::to($newCoreAddress);
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>