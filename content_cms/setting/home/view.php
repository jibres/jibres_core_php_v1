<?php
namespace content_cms\setting\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Set image ratio'));
		\dash\data::back_text(T_("CMS"));
		\dash\data::back_link(\dash\url::here());

		\dash\data::cmsSettingSaved(\lib\app\setting\get::cms_setting());

	}
}
?>