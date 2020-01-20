<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();

		if(\dash\url::module() === 'v1')
		{
			\content_api\v1\check::basic_api_detail();
		}
		if(\dash\url::module() === 'v2')
		{
			\content_api\v2\check::basic_api_detail();
		}
	}


	private static function check_subdomain_and_content()
	{
		// replace api form content to subdomain
		if(\dash\url::subdomain() === null)
		{
			$newApiAddress = \dash\url::set_subdomain('api');
			if(\dash\url::directory())
			{
				$newApiAddress .= '/'. \dash\url::directory();
			}
			\dash\redirect::to($newApiAddress);
		}
	}
}
?>