<?php
namespace content_sudo\tg\webhook;

class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::title(T_("Telegram webhook"));

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