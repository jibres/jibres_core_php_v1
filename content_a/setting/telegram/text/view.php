<?php
namespace content_a\setting\telegram\text;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Telegram Share Text'));

		// back
		\dash\data::back_text(T_('Telegram setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::telegramSettingSaved(\lib\app\setting\get::telegram_setting());

	}
}
?>