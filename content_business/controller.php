<?php
namespace content_business;

class controller
{
	public static function routing()
	{

		if(\dash\engine\store::free_subdomain())
		{
			\dash\engine\prepare::html_raw_page('dnsPoint');
		}
		else
		{
			if(!\lib\store::id())
			{
				\dash\header::status(404, T_("Store not found"));
			}

			\lib\store::check_master_business_config();
		}

		// redirect factor short address to full address
		$module = \dash\url::module();
		if(!\dash\url::child() && $module && substr($module, 0, 1) === ':' && \dash\validate::id(substr($module, 1), false))
		{
			$factor_id = \dash\validate::id(substr($module, 1), false);
			$new_url = \dash\url::kingdom(). '/orders/view?id='. $factor_id;
			\dash\redirect::to($new_url);
			return;
		}
	}
}
?>