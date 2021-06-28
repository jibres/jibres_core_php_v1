<?php
namespace content_site\page\settings;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Page setting'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>