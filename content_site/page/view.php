<?php
namespace content_site\page;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Page'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::btnSaveSiteBuilder(true);

		$link = \dash\data::currentPageDetail_link();

		if(\dash\data::currentPageDetail_status() !== 'publish')
		{
			$link .= '?preview=yes';
		}
		\dash\data::btnPreviewSiteBuilder($link);

	}
}
?>