<?php
namespace content_n;


class view
{
	public static function config()
	{
		if(\dash\engine\store::inStore())
		{
			$store_logo = \lib\store::logo();
			if($store_logo && !\dash\face::cover())
			{
				\dash\face::cover($store_logo);
				\dash\face::twitterCard('summary');
				\dash\face::logo($store_logo);
			}
		}
		\dash\face::titlePWA(\lib\store::title());
	}
}
?>