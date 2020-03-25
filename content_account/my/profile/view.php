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
	}
}
?>