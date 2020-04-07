<?php
namespace content_v2;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();

		if(in_array(\dash\url::module(), ['doc', 'location']))
		{
			// needless to check store, appkey and apikey
		}
		else
		{
			if(!\lib\store::id())
			{
				\dash\header::status(403, T_("Store not found"));
			}

			\content_v2\tools::master_check();
		}
	}


	private static function check_subdomain_and_content()
	{
		$subdomain = \dash\url::subdomain();

		// replace api form content to subdomain
		if($subdomain === null)
		{
			$newCoreAddress = \dash\url::set_subdomain('api');

			if(\dash\url::path())
			{
				$newCoreAddress .= \dash\url::path();
			}
			\dash\redirect::to($newCoreAddress);
		}


		if($subdomain !== 'api')
		{
			\dash\header::status(404, T_("Invalid subdomain. remove subdomain to continue"));
		}
	}
}
?>