<?php
namespace lib\app\plugin\items\remove;


class remove_brand
{
	public static function detail()
	{
		return
		[
			'type'          => 'periodic',
			'comperatprice' => 200000,
			'price'         => 100000,
			'price_list'  =>
			[
				[
					'key'           => 'monthly',
					'plus_day'      => 31, // day
					'title'         => T_("One month"),
					'comperatprice' => 200000,
					'price'         => 100000,
				],
				[
					'key'           => 'yearly',
					'plus_day'      => 366, // day
					'title'         => T_("One year"),
					'comperatprice' => 2400000,
					'price'         => 1000000,
				],
			],
			'relase_date' => '2021-10-24',
			'last_update' => '2021-10-24',
			'title'       => T_("Remove jibres branding"),
			'description' => T_("Description"),
			'keywords'    => [T_("brand"), T_("jibres")],

		];

	}

}
?>