<?php
namespace content_account\my\username;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Username'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>