<?php
namespace content_account\my\email;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Email'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
