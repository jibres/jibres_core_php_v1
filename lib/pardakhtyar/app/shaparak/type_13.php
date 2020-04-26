<?php
namespace lib\pardakhtyar\app\shaparak;


class type_13
{
	public static function run($_id)
	{
		$merchant = \lib\pardakhtyar\app\shaparak\request::load_customer($_id);

		$shop = \lib\pardakhtyar\app\shaparak\request::load_shop($_id);

		$send                            = [];
		$send['trackingNumberPsp']       = 'customer_'. $_id;
		$send['requestType']             = 13;
		$send['merchant']                = $merchant;
		$send['relatedMerchants']        = null;
		$send['contract']                = null;

		if($shop)
		{
			$send['pspRequestShopAcceptors'] =
			[
				[
					'shop'      => $shop,
					'acceptors' => null
				],
			];
		}
		else
		{
			$send['pspRequestShopAcceptors'] = null;
		}

		$send['description']             = null;



		$result = \lib\pardakhtyar\start::request($send, $_id);

		return \lib\pardakhtyar\app\shaparak\request::analyze_result($result, $_id);
	}
}
?>