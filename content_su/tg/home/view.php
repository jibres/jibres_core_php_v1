<?php
namespace content_su\tg\home;

class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\face::title(T_("Telegram"));

		\dash\data::action_text(T_('Check logs'));
		\dash\data::action_link(\dash\url::this().'/log');

		\dash\data::badge2_text(T_('Back to supervisor dashboard'));
		\dash\data::badge2_link(\dash\url::this());

		\dash\data::tg_info(\dash\social\telegram\tg::setting());
	}
}
?>