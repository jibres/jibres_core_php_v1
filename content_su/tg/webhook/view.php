<?php
namespace content_su\tg\webhook;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Telegram webhook"));

		\dash\data::action_text(T_('Back to Telegram dashboard'));
		\dash\data::action_link(\dash\url::this());


		// read data from session
		\dash\data::tg_send(\dash\session::get('tg_send'));
		\dash\data::tg_response(\dash\session::get('tg_response'));

		\dash\session::set('tg_send', null);
		\dash\session::set('tg_response', null);


		\dash\data::hook(\dash\social\telegram\tg::json_getWebhookInfo());
	}
}
?>