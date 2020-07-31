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

		$store_logo = \lib\store::logo();
		if($store_logo)
		{
			\dash\face::cover($store_logo);
			\dash\face::twitterCard('summary');
			\dash\face::logo($store_logo);
		}

		// @todo reza use new class to only load and return store
		\dash\layout\business::check_website();

		switch (\dash\data::website_template())
		{
			case 'comingsoon':
				break;

			case 'visitcard':
				\dash\face::css('business/visitcard-1/visitcard-1.css');
				break;

			default:
				break;
		}

	}
}
?>