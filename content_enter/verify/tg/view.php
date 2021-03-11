<?php
namespace content_enter\verify\tg;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Verify by Telegram"));
		\dash\face::desc(' ');


		\dash\data::back_link(\dash\url::here(). '/verify');
		\dash\data::back_text(T_('Back'));

		\dash\data::tbBot('JibresBot');

	}
}
?>