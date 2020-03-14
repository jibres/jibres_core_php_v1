<?php
namespace content_account\personalization\language;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Language'));

		// back
		\dash\data::back_text(T_('Personalization'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
