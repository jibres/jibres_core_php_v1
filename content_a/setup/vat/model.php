<?php
namespace content_a\setup\vat;


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

		\lib\app\setting\setup::save_vat($post);
		\lib\store::refresh();
		$next_level = \lib\app\setting\setup::vat();
		\dash\redirect::to($next_level);
	}
}
?>
