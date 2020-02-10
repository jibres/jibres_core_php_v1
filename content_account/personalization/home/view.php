<?php
namespace content_account\personalization\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Personalization'));
		\dash\data::page_desc(T_('Your data, activity, and preferences that help make our services more useful to you'));
		\dash\data::page_tbox(false);

		\dash\data::badge_link(\dash\url::here());
		\dash\data::badge_text(T_('Back to Account'));

		// back
		\dash\data::page_backText(T_('Account'));
		\dash\data::page_backLink(\dash\url::here());

		\dash\data::isLtr(\dash\language::dir() === 'ltr' ? true : false);

		if(\dash\data::dataRow_language())
		{
			\dash\data::LnagName(\dash\language::get(\dash\data::dataRow_language(), 'localname'));
		}

		if(\dash\data::dataRow_theme())
		{
			$myKey = \dash\data::dataRow_theme();
			\dash\data::ThemeName(\dash\utility\theme::get($myKey, 'name'));
		}
	}
}
?>
