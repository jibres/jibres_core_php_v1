<?php
namespace content\status;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Real Time Status'));
		\dash\face::desc("Welcome to Jibres real-time and historical data on system performance.");
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>