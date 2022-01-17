<?php
namespace lib\app\plugin\items\ganje;


class ganje_product
{

	public static function detail() : array
	{
		return
		[
			'title'         => T_("Ganje"),
			'name'          => 'ganje_product',
			'type'          => 'periodic',
			'price_list'  =>
			[
				[
					'key'           => 'monthly',
					'plus_day'      => 31, // day
					'title'         => T_("One month"),
					'comperatprice' => 50000,
					'price'         => 20000,
				],
				[
					'key'           => 'yearly',
					'plus_day'      => 366, // day
					'title'         => T_("One year"),
					'default'       => true,
					'comperatprice' => 200000,
					'price'         => 150000,
				],
			],
			'max_period'  => '+400day', // +400 day 366+31 = 397 ~ 400
			'relase_date' => '2022-01-16',
			'last_update' => '2022-01-16',
			'icon'        => ['gem', 'bootstrap'],
			'description' => self::desc(),
			'keywords'    => [T_("ganje"), T_("product"), T_("barcode")],
			'currency'    => \lib\currency::jibres_currency(true),
		];

	}


	public static function more_detail() : string
	{
		$html  = '';

		$html .= '<div>';
		{
			$html .= T_("By purchasing this plugin, this feature will be created for your business so that the edit load of each product, if your product information is found in Ganje repositories, you can update them with one click.");
		}
		$html .= '</div>';

		return $html;

	}


	private static function desc() : string
	{
		return T_("This repository includes more than 68,000 supermarket products along with name, barcode, category, technical title and quality image, which were provided to you after refinement and sorting. You can simply get the product detail from the list of Ganje products by scanning the barcode or searching for the product name and easily add it to your product list.");
	}


}
?>