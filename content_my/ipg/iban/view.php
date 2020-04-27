<?php
namespace content_my\ipg\iban;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Bank account number'));

		\content_my\ipg\stepGuide::set();
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		// $ibanDetail = \lib\app\ipg\iban\get::my_default_iban();
		// \dash\data::ibanDetail($ibanDetail);
	}
}
?>