<?php
namespace content_business;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

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

		// $store_logo = \lib\store::logo();
		// if($store_logo)
		// {
		// 	\dash\face::cover($store_logo);
		// }

	}
}
?>