<?php
namespace content_a\setting\telegram\channel;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Telegram channel'));

		// back
		\dash\data::back_text(T_('Telegram setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::telegramSettingSaved(\lib\app\setting\get::telegram_setting());

	}
}
?>