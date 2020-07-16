<?php
namespace content_business\cart;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Cart"));

		$dataTable = \lib\app\cart\search::my_detail();

		\dash\data::dataTable($dataTable);

		$cartSummary = \lib\app\cart\search::my_detail_summary($dataTable);

		\dash\data::cartSummary($cartSummary);

		$cart_setting = \lib\app\setting\get::cart_setting();
		\dash\data::cartSettingSaved($cart_setting);



	}
}
?>
