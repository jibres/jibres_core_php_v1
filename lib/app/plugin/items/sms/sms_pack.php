<?php
namespace lib\app\plugin\items\sms;


class sms_pack
{

	public static function detail() : array
	{
		return
		[
			'title'         => T_("SMS"),
			'name'          => 'sms_pack',
			'type'          => 'counting_package',
			'price_list'  =>
			[
				[
					'key'           => 'pack_1000',
					'count'         => 1000,
					'title'         => T_("A package of :val SMS", ['val' => \dash\fit::number(1000)]),
					'comperatprice' => 50000,
					'price'         => 50000,
				],
				[
					'key'           => 'pack_5000',
					'count'         => 5000,
					'title'         => T_("A package of :val SMS", ['val' => \dash\fit::number(5000)]),
					'comperatprice' => 200000,
					'price'         => 200000,
				],
				[
					'key'           => 'pack_10000',
					'count'         => 10000,
					'title'         => T_("A package of :val SMS", ['val' => \dash\fit::number(10000)]),
					'comperatprice' => 400000,
					'price'         => 400000,
				],
			],
			'max_count'             => 100000, // +100,000
			'relase_date'           => '2022-02-05',
			'last_update'           => '2022-02-05',
			'disable_auto_discount' => true,
			'icon'        => ['envelope', 'bootstrap'],
			'description' => self::desc(),
			'keywords'    => [T_("SMS"), T_("Management")],
			'currency'    => \lib\currency::jibres_currency(true),
		];

	}


	public static function more_detail() : string
	{
		$html  = '';

		$html .= '<div>';
		{
			$html .= T_("Each package contains a certain number of SMS and you can purchase several packages at the same time");
		}
		$html .= '</div>';

		return $html;

	}


	private static function desc() : string
	{
		return T_("You can send informational and service SMS in your website by purchasing an SMS package.");
	}


}
?>