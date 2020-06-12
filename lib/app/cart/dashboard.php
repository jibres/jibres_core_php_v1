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
		$result['price']   = \lib\price::down(intval(\dash\get::index($result_raw, 'price')));
		$result['item']    = intval(\dash\get::index($result_raw, 'item'));
		$result['product'] = intval(\dash\get::index($result_raw, 'product'));


		return $result;
	}
}
?>