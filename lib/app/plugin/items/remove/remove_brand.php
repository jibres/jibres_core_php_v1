<?php
namespace lib\app\plugin\items\remove;


class remove_brand
{

	public static function detail() : array
	{
		if(!\dash\url::isLocal())
		{
			return [];
		}

		return
		[
			'title'         => T_("Remove jibres brand"),
			'name'          => 'remove_brand',
			'type'          => 'periodic',
			'price_list'  =>
			[
				[
					'key'           => 'monthly',
					'plus_day'      => 31, // day
					'title'         => T_("One month"),
					'comperatprice' => 100000,
					'price'         => 100000,
				],
				[
					'key'           => 'yearly',
					'plus_day'      => 366, // day
					'title'         => T_("One year"),
					'default'       => true,
					'comperatprice' => 1200000,
					'price'         => 1000000,
				],
			],
			'max_period'  => '+400day', // +400 day 366+31 = 397 ~ 400
			'relase_date' => '2022-01-30',
			'last_update' => '2022-01-30',
			'icon'        => '<img src="'. \dash\url::icon(). '">',
			'description' => self::desc(),
			'keywords'    => [T_("brand"), T_("Jibres")],
			'currency'    => \lib\currency::jibres_currency(true),
		];

	}


	public static function more_detail() : string
	{
		$html  = '';

		$html .= '<div>';
		{

			// $html .= T_("These features include");
			// $html .= '<br>';
			// $html .= T_("Assigning discount code to a specific product category or product");
			// $html .= '<br>';
			// $html .= T_("Set the minimum purchase amount or the minimum number of items in the order to activate the discount code");
			// $html .= '<br>';
			// $html .= T_("Ability to assign to a specific group of customers or clients");
			// $html .= '<br>';
			// $html .= T_("Ability to limit to one use per customer");
			// $html .= '<br>';
			// $html .= T_("Ability to set the expiration date of the discount code");
			// $html .= '<br>';
		}
		$html .= '</div>';

		return $html;

	}


	private static function desc() : string
	{
		return T_("Remove jibres brand from footer of website");
	}



}
?>