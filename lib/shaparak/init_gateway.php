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
			$load_acceptor = \lib\app\shaparak\acceptor\add::new_acceptor($load_shop['user_id']);
		}

		$load_terminal = \lib\db\shaparak\terminal\get::by_user_id($load_shop['user_id']);
		if(!isset($load_terminal['id']))
		{
			$load_terminal = \lib\app\shaparak\terminal\add::new_terminal($load_shop['user_id']);
		}

		$load_contract = \lib\db\shaparak\contract\get::by_user_id($load_shop['user_id']);
		if(!isset($load_contract['id']))
		{
			$load_contract = \lib\app\shaparak\contract\add::new_contract($load_shop['user_id']);
		}

		$load_shop     = \lib\app\shaparak\shop\ready::for_shaparak($load_shop);
		$load_customer = \lib\app\shaparak\profile\ready::for_shaparak($load_customer);
		$load_ibans    = array_map(['\\lib\\app\\shaparak\\iban\\ready', 'for_shaparak'], $load_ibans);
		$load_acceptor = \lib\app\shaparak\acceptor\ready::for_shaparak($load_acceptor);
		$load_terminal = \lib\app\shaparak\terminal\ready::for_shaparak($load_terminal);
		$load_contract = \lib\app\shaparak\contract\ready::for_shaparak($load_contract);

		$result        = self::send($load_customer, $load_ibans, $load_shop, $load_acceptor, $load_contract, $load_terminal);



	}

	public static function send($_merchant, $_ibans, $_shop, $_acceptor, $_contract, $_load_terminal)
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

		$acceptor['terminals'] = [$_load_terminal];

		$merchantIban = array_column($ibans, 'merchantIban');

		$acceptor['shaparakSettlementIbans'] = $merchantIban;

		$send                            = [];
		$send['trackingNumberPsp']       = 'Jibres-5-'. date("Y-m-d.H:i:s"). '-'. \dash\coding::encode(rand(1, 9999). rand(1, 9999));
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

		$send = [$send];

		$result = \lib\shaparak\exec::run($send, 5);

		return $result;
	}

}
?>