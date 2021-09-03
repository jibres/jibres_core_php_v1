<?php
namespace content_business\cart;


class view
{
	public static function config()
	{
		$title = T_("Shopping Cart"). ' ('. \dash\fit::number(\lib\app\cart\get::my_cart_count()). ')';
		\dash\face::titlePWA($title);
		\dash\face::title($title);

		$cart_detail = \lib\app\cart\search::my_detail();
		
		\dash\data::dataTable($cart_detail);

		$cart_summary = \lib\app\cart\search::my_detail_summary($cart_detail);

		\dash\data::cartSummary($cart_summary);

		$cart_setting = \lib\app\setting\get::cart_setting();
		\dash\data::cartSettingSaved($cart_setting);

		// btn
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>
