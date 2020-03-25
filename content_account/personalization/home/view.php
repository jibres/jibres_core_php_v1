<?php
namespace content_account\personalization\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Personalization'));
		\dash\face::desc(T_('Your data, activity, and preferences that help make our services more useful to you'));

		// back
		\dash\data::back_text(T_('Account'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::isLtr(\dash\language::dir() === 'ltr' ? true : false);

		if(\dash\data::dataRow_language())
		{
			\dash\data::LnagName(\dash\language::get(\dash\data::dataRow_language(), 'localname'));
		}

	}
}
?>
