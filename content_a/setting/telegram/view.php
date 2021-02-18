<?php
namespace content_a\setting\telegram;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Telegram setting'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');

		\dash\data::telegramSettingSaved(\lib\app\setting\get::telegram_setting());
	}
}
?>