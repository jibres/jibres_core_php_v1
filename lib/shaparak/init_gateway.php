<?php
namespace lib\shaparak;


class init_gateway
{
	public static function run($_shop_id)
	{
		return;
		$load_shop = \lib\db\shaparak\shop\get::by_id($_shop_id);
		if(!isset($load_shop['user_id']))
		{
			\dash\notif::error(T_("Invalid shop detail"));
			return false;
		}

		$load_customer = \lib\db\shaparak\customer\get::by_user_id($load_shop['user_id']);
		if(!isset($load_customer['user_id']))
		{
			\dash\notif::error(T_("Invalid customer detail"));
			return false;
		}

		$load_ibans = \lib\db\shaparak\iban\get::by_user_id($load_shop['user_id']);


		$load_acceptor = \lib\db\shaparak\acceptor\get::by_user_id($load_shop['user_id']);
		if(!isset($load_acceptor['id']))
		{
			$new_acceptor =
			[
			];
		}
		var_dump($load_acceptor);exit();

		var_dump($load_ibans);
		var_dump($load_customer);
		var_dump($load_shop);
		var_dump($_shop_id);exit();

		// $result = self::send($load_customer, $load_ibans, $load_shop, $load_acceptor, $_load_contract);



	}

	public static function send($_merchant, $_ibans, $_shop, $_acceptor, $_contract)
	{

		$merchant = $_merchant;


		$merchantIbans = [];

		$ibans = $_ibans;

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

		$shop = $_shop;

		$acceptor = $_acceptor;

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
		$send['contract']                = $_contract;
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

	private static function contract($_shop_id)
	{

	}

}
?>