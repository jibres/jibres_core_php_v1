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

		$profileDetail = \lib\app\ipg\profile\get::my_profile();
		\dash\data::profileDetail($profileDetail);

		$ibanDetail = \lib\app\ipg\iban\get::my_default_iban();
		\dash\data::ibanDetail($ibanDetail);

		$gatewayDetail = \lib\app\ipg\gateway\get::my_first_gateway();
		\dash\data::gatewayDetail($gatewayDetail);

	}
}
?>