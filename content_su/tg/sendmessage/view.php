<?php
namespace content_su\tg\sendmessage;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Send message"));

		\dash\data::action_text(T_('Back to Telegram dashboard'));
		\dash\data::action_link(\dash\url::this());


		\dash\data::tg_send(\dash\session::get('tg_send'));
		\dash\data::tg_response(\dash\session::get('tg_response'));

		\dash\session::set('tg_send', null);
		\dash\session::set('tg_response', null);
	}
}
?>