<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		\dash\face::site(\lib\store::detail('title'));
		\dash\face::title(\lib\store::detail('title'));

		\dash\face::desc(\lib\store::detail('desc'));
		\dash\face::intro(\lib\store::detail('desc'));

		if(\dash\url::isLocal())
		{
			$website = \lib\app\website\template::get();
			\dash\data::website($website);
		}


	}
}
?>