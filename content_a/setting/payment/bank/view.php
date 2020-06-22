<?php
namespace content_a\setting\payment\bank;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Payment'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::bankSetting(\lib\app\setting\get::bank_payment_setting());

	}
}
?>
