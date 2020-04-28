<?php
namespace content_my\ipg\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Internet Payment Gateway'));

		\dash\data::loadScript('/js/chart/my/ipg_home.js');

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$profileDetail = \lib\app\shaparak\profile\get::my_profile();
		\dash\data::profileDetail($profileDetail);

		$ibanDetail = \lib\app\shaparak\iban\get::my_default_iban();
		\dash\data::ibanDetail($ibanDetail);

		$gatewayDetail = \lib\app\shaparak\shop\get::my_first_shop();
		\dash\data::gatewayDetail($gatewayDetail);

	}
}
?>