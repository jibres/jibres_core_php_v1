<?php
namespace lib\pardakhtyar\app\shaparak;


class type_5
{

	public static function run($_id)
	{
		$merchant = \lib\pardakhtyar\app\shaparak\request::load_customer($_id);


		$merchantIbans = [];

		$ibans = \lib\pardakhtyar\db\merchantIbans::get_by_customer_id($_id);
		if(is_array($ibans))
		{
			foreach ($ibans as $key => $value)
			{
				$merchantIbans[] =
				[
					'merchantIban' => $value['merchantIban'],
					"description"  => null,
				];
			}
			$merchant['merchantIbans'] = $merchantIbans;
		}

		$shop = \lib\pardakhtyar\app\shaparak\request::load_shop($_id);

		$acceptor = \lib\pardakhtyar\app\shaparak\request::load_acceptor($_id);

		if(!$acceptor)
		{
			\dash\notif::error('acceptor not found');
			return false;
		}

		$send                            = [];
		$send['trackingNumberPsp']       = 'customer_'. $_id;
		$send['requestType']             = 5;
		$send['merchant']                = $merchant;
		$send['relatedMerchants']        = null;
		$send['contract']                = \lib\pardakhtyar\contract::get();
		$send['pspRequestShopAcceptors'] =
		[
			[
				'shop'      => $shop,
				'acceptors' => [$acceptor]
			],
		];

		$send['description']             = null;



		$result = \lib\pardakhtyar\start::request($send, $_id);

		return \lib\pardakhtyar\app\shaparak\request::analyze_result($result, $_id);
	}

}
?>