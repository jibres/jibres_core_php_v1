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

			$nosale = \lib\store::detail('nosale');
			if($nosale)
			{
				\dash\data::nosale(true);
			}
		}
	}
}
?>