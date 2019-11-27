<?php
namespace content_a\setup\shipping;


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

		$result = \lib\app\setting\setup::save_shipping($post);

		if ($result)
		{
			// save every field in somewhere and set the shipping detail is complete
			$next_level = \lib\app\setting\setup::shipping();
			\dash\redirect::to($next_level);
		}
	}
}
?>
