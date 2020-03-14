<?php
namespace content_su\tg\home;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Telegram"));
		\dash\data::page_desc(T_('Check Telegram bot api status and play with it.'));

		\dash\data::action_text(T_('Check logs'));
		\dash\data::action_link(\dash\url::this().'/log');

		\dash\data::badge2_text(T_('Back to supervisor dashboard'));
		\dash\data::badge2_link(\dash\url::this());

		\dash\data::tg_info(\dash\social\telegram\tg::setting());
	}
}
?>