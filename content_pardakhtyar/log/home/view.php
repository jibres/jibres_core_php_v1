<?php
namespace content_pardakhtyar\log;


class view
{
	public static function config()
	{
		$myTitle = T_("log");

		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text(T_('Back to dashboard'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>