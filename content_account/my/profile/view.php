<?php
namespace content_account\my\profile;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Profile'));

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to personal info'));



		\dash\data::isLtr(\dash\language::dir() === 'ltr' ? true : false);
	}
}
?>