<?php
namespace content_a\setting\shipping;


class model
{
	public static function post()
	{
		$post                                        = [];
		$post['shipping_status']                     = \dash\request::post('shipping_status');
		$post['shipping_current_country']            = \dash\request::post('shipping_current_country');
		$post['shipping_current_country_value']      = \dash\request::post('shipping_current_country_value');
		$post['shipping_current_country_value_type'] = \dash\request::post('shipping_current_country_value_type');
		$post['shipping_other_country']              = \dash\request::post('shipping_other_country');
		$post['shipping_other_country_value']        = \dash\request::post('shipping_other_country_value');
		$post['shipping_other_country_value_type']   = \dash\request::post('shipping_other_country_value_type');
		$post['length_unit']                         = \dash\request::post('length_unit');
		$post['mass_unit']                           = \dash\request::post('mass_unit');

		\lib\app\setting\setup::save_shipping($post);
	}
}
?>
