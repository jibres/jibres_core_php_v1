<?php
namespace content_account\my\avatar;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Set Avatar'));

		// back
		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Personal info'));

	}
}
?>
