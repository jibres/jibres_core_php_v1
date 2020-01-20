<?php
namespace content_core;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();

		if(\dash\url::module() === 'v3')
		{
			\content_core\v3\check::basic_core_detail();
		}
	}


	private static function check_subdomain_and_content()
	{
		// replace core form content to subdomain
		if(\dash\url::subdomain() === null)
		{
			$newCoreAddress = \dash\url::set_subdomain('core');
			if(\dash\url::directory())
			{
				$newCoreAddress .= '/'. \dash\url::directory();
			}
			\dash\redirect::to($newCoreAddress);
		}
	}
}
?>