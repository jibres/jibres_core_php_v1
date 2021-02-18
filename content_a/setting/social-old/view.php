<?php
namespace content_a\setting\social;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Social Network'));


		// back
		\dash\data::telegramSettingSaved(\lib\app\setting\get::telegram_setting());

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>