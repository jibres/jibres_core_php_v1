<?php
namespace content_account\my\username;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Username'));

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to personal info'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>