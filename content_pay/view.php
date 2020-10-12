<?php
namespace content_pay;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		// \dash\data::userToggleSidebar(false);

		if(\dash\engine\store::inStore())
		{
			$store_title = \lib\store::detail('title');
			if($store_title)
			{
				\dash\face::site($store_title);
				\dash\face::title($store_title);
			}

			$store_desc = \lib\store::detail('desc');
			if($store_desc)
			{
				\dash\face::desc($store_desc);
				\dash\face::intro($store_desc);
			}

			$store_logo = \lib\store::logo();
			if($store_logo)
			{
				\dash\face::cover($store_logo);
				\dash\face::twitterCard('summary');
				\dash\face::logo($store_logo);
			}
		}
	}
}
?>