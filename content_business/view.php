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

			$store_short_title = \lib\store::detail('shorttitle');
			if($store_short_title && \dash\request::is_pwa())
			{
				\dash\face::title($store_short_title);
			}
		}

		if(\dash\request::get('preview'))
		{
			\dash\data::HtmlPointerEventsNone(true);
		}

		$store_desc = \lib\store::detail('desc');
		if($store_desc)
		{
			\dash\face::desc($store_desc);
			\dash\face::intro($store_desc);
		}
		else
		{
			\dash\face::desc($store_title);
		}

		$store_logo = \lib\store::logo();
		if($store_logo && !\dash\face::cover())
		{
			\dash\face::cover($store_logo);
			\dash\face::twitterCard('summary');
			\dash\face::logo($store_logo);
		}

		\dash\upload\size::set_default_file_size('business');

	}

}
?>