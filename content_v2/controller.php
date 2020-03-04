<?php
namespace content_v2;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();

		if(in_array(\dash\url::module(), ['doc', 'location']))
		{

		}
		else
		{
			self::check_store();
			\content_v2\tools::master_check();
		}
	}


	private static function check_store()
	{
		if(!\lib\store::id())
		{
			\dash\header::status(403, T_("Store not found"));
		}
	}

	private static function check_subdomain_and_content()
	{
		// replace api form content to subdomain
		if(\dash\url::subdomain() === null)
		{
			$newCoreAddress = \dash\url::set_subdomain('api');

			if(\dash\url::path())
			{
				$newCoreAddress .= \dash\url::path();
			}
			\dash\redirect::to($newCoreAddress);
		}
	}
}
?>