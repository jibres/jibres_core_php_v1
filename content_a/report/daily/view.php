<?php
namespace content_a\report\daily;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Report daily'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));

		\dash\data::badge_text(T_('Back to report list'));
		\dash\data::badge_link(\dash\url::this());

		$reportLast30Days = \lib\app\report\daily::last_30_days();

		\dash\data::reportLast30Days($reportLast30Days);
	}
}
?>
