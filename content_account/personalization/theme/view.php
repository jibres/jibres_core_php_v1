<?php
namespace content_account\personalization\theme;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Theme'));

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to personal info'));

		// back
		\dash\data::page_backText(T_('Personalization'));
		\dash\data::page_backLink(\dash\url::this());

		$themeList = \dash\utility\theme::all();

		\dash\data::themeList($themeList);


	}
}
?>
