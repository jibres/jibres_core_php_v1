<?php
namespace lib\app\plugin\items\admin;


class admin_domain
{

	public static function detail() : array
	{
		return
		[
			'title'         => T_("Dedicated domain for admin panel"),
			'name'          => 'admin_domain',
			'type'          => 'periodic',
			'price_list'  =>
			[
				[
					'key'           => 'monthly',
					'plus_day'      => 31, // day
					'title'         => T_("One month"),
					'comperatprice' => 50000,
					'price'         => 50000,
				],
				[
					'key'           => 'yearly',
					'plus_day'      => 366, // day
					'title'         => T_("One year"),
					'default'       => true,
					'comperatprice' => 600000,
					'price'         => 300000,
				],
			],
			'max_period'  => '+400day', // +400 day 366+31 = 397 ~ 400
			'relase_date' => '2022-01-27',
			'last_update' => '2022-01-27',
			'icon'        => ['globe2', 'bootstrap'],
			'description' => self::desc(),
			'keywords'    => [T_("domain"), T_("admin"), T_("dedicated")],
			'currency'    => \lib\currency::jibres_currency(true),
		];

	}


	public static function more_detail() : string
	{
		$html  = '';

		$html .= '<div>';
		{

		}
		$html .= '</div>';

		return $html;

	}


	private static function desc() : string
	{
		return T_("Using this feature, you can do your own business management section through your website, and you do not need to enter the Jibres website to enter the business management section.");
	}


}
?>