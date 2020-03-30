<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());


		\dash\face::site(\dash\get::index(\dash\data::store(), 'store_data', 'title'));
		\dash\face::intro(\dash\data::store_desc());

		if(\dash\url::isLocal())
		{
			$website = \lib\app\website\template::get();
			\dash\data::website($website);
		}


	}
}
?>