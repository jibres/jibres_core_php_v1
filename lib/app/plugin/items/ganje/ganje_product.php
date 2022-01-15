<?php
namespace lib\app\plugin\items\ganje;


class ganje_product
{
	public static function detail()
	{
		return
		[
			'type'          => 'once',
			'comperatprice' => 200000,
			'price'         => 100000,
			'relase_date'   => '2021-10-24',
			'last_update'   => '2021-10-24',
			'title'         => T_("Fetch product detail from ganje"),
			'description'   => T_("Ganje contain more than 68,000 product with barcode and beautiful gallery"),
			'keywords'      => [T_("ganje"), T_("product")],

		];

	}

}
?>