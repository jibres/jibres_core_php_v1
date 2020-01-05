<?php
namespace content_a\setting\vat;


class model
{
	public static function post()
	{
		$post =
		[
			'tax_status'         => \dash\request::post('tax_status'),
			'tax_calc'           => \dash\request::post('tax_calc'),
			'tax_calc_all_price' => \dash\request::post('tax_calc_all_price'),
			'tax_shipping'       => \dash\request::post('tax_shipping'),
		];

		\dash\notif::direct();

		\lib\app\setting\setup::save_vat($post);

	}
}
?>
