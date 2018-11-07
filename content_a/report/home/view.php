<?php
namespace content_a\report\home;


class view
{
	public static function config()
	{
		\dash\permission::access('reportView');

		\dash\data::page_title(T_('Report list'));
		\dash\data::page_desc(T_('Show and analyze best report in this platform.'));

		\dash\data::badge_text(T_('Back to store dashboard'));
		\dash\data::badge_link(\dash\url::here());
	}
}
?>
