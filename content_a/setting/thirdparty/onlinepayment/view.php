<?php
namespace content_a\setting\thirdparty\onlinepayment;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Payment'));

		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::bankSetting(\lib\app\setting\get::bank_payment_setting());

	}
}
?>
