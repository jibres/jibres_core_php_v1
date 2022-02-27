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
					'package_count' => 1000,
					'title'         => T_("A package of :val SMS", ['val' => \dash\fit::number(1000)]),
					'comperatprice' => 50000,
					'price'         => 50000,
				],
				[
					'key'           => 'pack_10000',
					'package_count' => 10000,
					'title'         => T_("A package of :val SMS", ['val' => \dash\fit::number(10000)]),
					'comperatprice' => 500000,
					'price'         => 450000,
				],
			],
			'max_count'             => 50000, // +50,000
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

		$html .= '<div class="mb-2">';
		{
			$html .= T_("Each package contains a certain number of SMS and you can purchase several packages at the same time");
		}
		$html .= '</div>';

		$args =
		[
			'data' =>
			[
				'my_id'            => '...',
				'my_amount'        => '...',
				'my_currency'      => \lib\store::currency(),
				'my_tackingnumber' => '...',
				'my_hide_link'     => true,
			],
		];

		$html .= '<div class="mb-2">';
		{
			$html .= T_("Below you can see examples of text messages that the system sends to the business manager or customers in different situations.");
		}
		$html .= '</div>';

		$sample =
		[
			T_("Before pay") => \lib\app\log\caller\order\order_adminNewOrderBeforePay::get_msg($args),
			T_("After pay") => \lib\app\log\caller\order\order_adminNewOrderAfterPay::get_msg($args),
			T_("New order") => \lib\app\log\caller\order\order_customerNewOrder::get_msg($args),
			T_("Sending order") => \lib\app\log\caller\order\order_customerSendingOrder::get_msg($args),
			T_("Tracking number") => \lib\app\log\caller\order\order_customerTrackingNumber::get_msg($args),
		];

		foreach ($sample as $event => $text)
		{
			$html .= '<div class="alert-info text-sm">';
			{
				$html .= '<b>' .$event. '</b>';
				$html .= '<br>';
				$html .= $text;
			}
			$html .= '</div>';
		}

		return $html;

	}


	private static function desc() : string
	{
		return T_("You can send informational and service SMS in your website by purchasing an SMS package.");
	}


}
?>