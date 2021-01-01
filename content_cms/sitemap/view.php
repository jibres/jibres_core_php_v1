<?php
namespace content_cms\sitemap;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sitemap'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting');

	}
}
?>