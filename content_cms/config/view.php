<?php
namespace content_cms\config;

class view
{
	public static function config()
	{
		\dash\face::title(T_('CMS Configuration'));
		\dash\data::back_text(T_("CMS"));
		\dash\data::back_link(\dash\url::here());

		\dash\data::cmsSettingSaved(\lib\app\setting\get::cms_setting());
	}
}
?>