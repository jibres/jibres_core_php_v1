<?php

namespace lib\app\business_sms;

class charge
{

	public static function getDetail()
	{
		$detail = \lib\api\jibres\api::business_sms_detail();

		if(isset($detail['result']))
		{
			return $detail['result'];
		}

		return [];
	}


	public static function newPay(array $_args)
	{
		$data = self::checkArgs($_args);

		$detail = \lib\api\jibres\api::business_sms_charge($data);

		if(isset($detail['result']['payLink']) && $detail['result']['payLink'])
		{
			\dash\redirect::to($detail['result']['payLink']);
		}
		else
		{
			return false;
		}

	}


	private static function checkArgs(array $_args)
	{
		$condition =
			[
				'turn_back'  => 'string_1000',
				'use_budget' => 'bit',
				'amount'     => 'price',
			];

		$require = ['amount'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	public static function pay($_business_id, array $_args)
	{
		$data = $_args;

		$userId = self::getUserId();

		$turnBack = $data['turn_back'];

		if(!$turnBack)
		{
			$turnBack = \dash\url::jibres_domain();
		}

		$price = $data['amount'];

		if($data['use_budget'])
		{
			$userBudget = \dash\app\transaction\budget::user($userId);
			$price      = $price - $userBudget;

			if($price < 0)
			{
				$price = 0;
			}
		}


		$payLink = null;

		if($price)
		{
			$fn_args =
				[
					'store_id' => $_business_id,
					'user_id'  => $userId,
					'price'    => $price,
				];

			$needPay = true;
			// go to bank
			$meta =
				[
					'store_id' => $_business_id,
					'caller'   => 'business:sms:pay',

					'pay_on_jibres' => true,
					'msg_go'        => T_("Charge SMS"),
					'auto_go'       => false,
					'auto_back'     => true,
					'final_msg'     => false,
					'turn_back'     => $turnBack,
					'user_id'       => $userId,
					'amount'        => $price,
					'final_fn'      => ['/lib/app/business_sms/charge', 'after_pay'],
					'final_fn_args' => $fn_args,


				];

			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				$payLink = $result_pay['url'];
			}
		}
		else
		{
			$needPay = false;
		}

		return ['payLink' => $payLink, 'needPay' => $needPay];
	}


	private static function getUserId()
	{
		if(\dash\engine\store::inStore())
		{
			$userId = \dash\user::jibres_user();
		}
		else
		{
			$userId = \dash\user::id();
		}

		return $userId;
	}


	public static function after_pay($_args, $_transaction_detail = [])
	{
		$args                   = $_args;
		$args['transaction_id'] = a($_transaction_detail, 'id');


	}


}