<?php
namespace content_account\my\email;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Email'));

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to personal info'));

		// back
		\dash\data::page_backText(T_('Personal info'));
		\dash\data::page_backLink(\dash\url::this());


	}
}
?>
