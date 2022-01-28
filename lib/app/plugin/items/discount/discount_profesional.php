<?php
namespace lib\app\plugin\items\discount;


class discount_profesional
{


	public static function detail() : array
	{
		return
		[
			'title'         => T_("Profesional discount code"),
			'name'          => 'discount_profesional',
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
			'relase_date' => '2022-01-27',
			'last_update' => '2022-01-27',
			'icon'        => ['piggy-bank', 'bootstrap'],
			'description' => self::desc(),
			'keywords'    => [T_("discount code"), T_("Management")],
			'currency'    => \lib\currency::jibres_currency(true),
		];

	}


	public static function more_detail() : string
	{
		$html  = '';

		$html .= '<div>';
		{

			$html .= T_("These features include");
			$html .= '<br>';
			$html .= T_("Assigning discount code to a specific product category or product");
			$html .= '<br>';
			$html .= T_("Set the minimum purchase amount or the minimum number of items in the order to activate the discount code");
			$html .= '<br>';
			$html .= T_("Ability to assign to a specific group of customers or clients");
			$html .= '<br>';
			$html .= T_("Ability to limit to one use per customer");
			$html .= '<br>';
			$html .= T_("Ability to set the expiration date of the discount code");
			$html .= '<br>';
		}
		$html .= '</div>';

		return $html;

	}


	private static function desc() : string
	{
		return T_("By activating this plugin, you can use the advanced features of creating a discount code");
	}


}
?>