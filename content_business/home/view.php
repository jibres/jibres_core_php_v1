<?php
namespace content_business\home;


class view
{
	public static function config()
	{
		// set business logo for homepage
		\dash\face::logoPWA(\lib\store::logo());

		\dash\data::search_link(\dash\url::kingdom().'/search');
	}
}
?>