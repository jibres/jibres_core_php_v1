<?php
namespace content_v2;


class controller
{
	public static function routing()
	{
		self::check_subdomain_and_content();
		self::check_module_is_stroe();
	}


	private static function check_module_is_stroe()
	{
		$module = \dash\url::module();
		if(!$module)
		{
			return;
		}

		$store_id = \dash\coding::decode($module);
		if(!$store_id)
		{
			\dash\header::status(404, T_("Invalid store code in url"));
		}

		if(intval($store_id) < 1000000 || \dash\number::is_larger($store_id, 9999999))
		{
			return false;
		}

		$detail = \dash\engine\store::init_by_id($store_id);

		if(!$detail)
		{
			\dash\header::status(403, T_("Store Detail not found"));
		}

		if(isset($detail['subdomain']))
		{
			\lib\store::set_store_slug($detail['subdomain']);

			if(!\lib\store::id())
			{
				\dash\header::status(404, T_("Store not found"));
			}
		}
		else
		{
			\dash\header::status(403, T_("subdomain not found"));
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