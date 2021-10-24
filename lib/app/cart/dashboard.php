<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class dashboard
{
	public static function admin()
	{
		$result            = [];
		$result_raw = \lib\db\cart\get::admin_dashboard();

		$count_cart = intval(\lib\db\cart\get::count_cart());

		$result['count']   = $count_cart;
		$result['price']   = floatval(intval(a($result_raw, 'price')));
		$result['item']    = intval(a($result_raw, 'item'));
		$result['product'] = intval(a($result_raw, 'product'));


		return $result;
	}
}
?>