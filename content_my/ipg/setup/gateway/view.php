<?php
namespace content_my\ipg\setup\gateway;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Gateway detail'));

		\content_my\ipg\setup\stepGuide::set();
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$gatewayDetail = \lib\app\shaparak\shop\get::my_first_shop();
		\dash\data::gatewayDetail($gatewayDetail);
	}
}
?>