<?php
namespace content_business\cart;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Cart"));
		\dash\face::titlePWA(T_("Shopping Cart"). ' ('. \dash\fit::number(\lib\website::cart_count()). ')');

		$dataTable = \lib\website::cart_detail();
		\dash\data::dataTable($dataTable);

		$cartSummary = \lib\website::cart_summary();
		\dash\data::cartSummary($cartSummary);

		$cart_setting = \lib\app\setting\get::cart_setting();
		\dash\data::cartSettingSaved($cart_setting);

		// btn
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>
