<?php
namespace content_account\my\profile;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Profile'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::isLtr(\dash\language::dir() === 'ltr' ? true : false);

		if(\dash\language::current() === 'fa' && \dash\data::dataRow_birthday())
		{
			\dash\data::dataRow_birthday(\dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_birthday())));
		}
	}
}
?>