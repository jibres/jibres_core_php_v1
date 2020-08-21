<?php
namespace content_business;

class controller
{
	public static function routing()
	{
		if(\dash\url::subdomain() === 'shop')
		{
			\dash\data::externalShop(true);
			// this is special page for shop aname
		}
		else
		{
			if(!\lib\store::id())
			{
				\dash\header::status(404, T_("Store not found"));
			}

			$nosale = \lib\app\setting\get::nosale_setting();

			if(isset($nosale['nosale']) && $nosale['nosale'])
			{
				\dash\data::nosale(true);
			}
		}
	}
}
?>