<?php
namespace lib\pardakhtyar\app\shaparak;


class type_18
{

	public static function run($_id)
	{
		$merchant = \lib\app\shaparak\request::load_customer($_id);

		$merchant['merchantIbans'] = null;


		$shop = \lib\app\shaparak\request::load_shop($_id);

		$acceptor = \lib\app\shaparak\request::load_acceptor($_id, true, false);

		if(!$acceptor)
		{
			\dash\notif::error('acceptor not found');
			return false;
		}

		$send                            = [];
		$send['trackingNumberPsp']       = 'customer_'. $_id;
		$send['requestType']             = 18;
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

		return \lib\app\shaparak\request::analyze_result($result, $_id);
	}

}
?>